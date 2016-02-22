using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System.Net;
using AuctionData.Database;

namespace AuctionData.WowAPI
{
    class QueryAh
    {
        private string apiurl;
        private long timestamp;
        private List<AhItem> _items;

        private DbConnector sql;

        public AhItem[] Items
        {
            get
            {
                return _items.ToArray();
            }
        }

        public long Timestamp
        {
            get
            {
                return this.timestamp;
            }
        }

        public bool DataAvailable
        {
            get
            {
                if (_items.Count > 0)
                    return true;
                return false;
            }
        }

        // Convert UTC unixtime to string of local datetime dd.MM.yy H:mm:ss
        private string dateFromUnix(long unixTime)
        {
            DateTime dateTime = new DateTime(1970, 1, 1, 0, 0, 0, 0, DateTimeKind.Utc);
            dateTime = dateTime.AddSeconds(unixTime).ToLocalTime();
            return dateTime.ToString("dd.MM.yy H:mm:ss");
        }

        public QueryAh(DbConnector sql)    
        {
            Logger.Write(LogType.INFO, "Initializing AuctionHouse class...");

            // Check that all needed info is at config file
            if (Config.GetString("apiurl") == null || Config.GetString("realm") == null || Config.GetString("realmlocale") == null || Config.GetString("apikey") == null)
                Logger.Write(LogType.FATAL, string.Format("Unable to initialize, some needed information couldn't be found. apiurl='{0}', realm='{1}', locale='{2}', apikey='{3}'", 
                    Config.GetString("apiurl"),
                    Config.GetString("realm"),
                    Config.GetString("realmlocale"),
                    new String(Config.GetString("apikey").Select(r => r == ' ' ? ' ' : 'X').ToArray()))); // For security, convert apikey to X's

            apiurl = Config.GetString("apiurl") + Config.GetString("realm") + "?locale=" + Config.GetString("realmlocale") + "&apikey=" + Config.GetString("apikey");
            _items = new List<AhItem>();

            this.sql = sql;

            Logger.Write(LogType.INFO, "Done.");
        }

        public void getNewData()
        {
            parseData(getAhData(getAhDataDlLink()));
        }

        private AhDownloadLink getAhDataDlLink()
        {
            string jsonString;
            dynamic json;

            // Download url
            try
            {
                using (WebClient wc = new WebClient())
                {
                    jsonString = wc.DownloadString(apiurl);
                }
            }
            catch (WebException ex)
            {
                Logger.Write(LogType.FATAL, "Could not retrieve the ah download string: " + ex.Message);
                return null;
            }

            // Parse json
            try
            {
                json = JsonConvert.DeserializeObject(jsonString);
            }
            catch (Exception ex)
            {
                Logger.Write(LogType.FATAL, "Unable to parse JSON: " + ex.Message);
                return null;
            }

            string url = Convert.ToString(json["files"][0]["url"]);
            string lastModifiedString = Convert.ToString(json["files"][0]["lastModified"]);

            timestamp = long.Parse(lastModifiedString.Remove(lastModifiedString.Length - 3));

            long lastModified = long.Parse(lastModifiedString);


            AhDownloadLink downloadLink = new AhDownloadLink(url, lastModified);
            return downloadLink;
        }

        // Get AH data from API and return it.
        // Returns dynamic (bypasses static type checking)
        private dynamic getAhData(AhDownloadLink downloadLink)
        {
            string ahDataString;
            dynamic json;

            try
            {
                using (WebClient wc = new WebClient())
                {
                    Logger.Write(LogType.INFO, "Starting to download AH data");
                    ahDataString = wc.DownloadString(downloadLink.URL);
                }
            }
            catch (WebException ex)
            {
                Logger.Write(LogType.FATAL, "Unable to download current AH data: " + ex.Message);
                return null; // Just return null so IDE is happy. We won't get in here since FATAL errors close the application.
            }

            Logger.Write(LogType.INFO, "Got AH data. Length: " + System.Text.Encoding.UTF8.GetByteCount(ahDataString) + " bytes.");

            try
            {
                json = JsonConvert.DeserializeObject(ahDataString);
            }
            catch (JsonException ex)
            {
                Logger.Write(LogType.FATAL, "Unable to parse AH data json: " + ex.Message);
                return null; // Just return null so IDE is happy. We won't get in here since FATAL errors close the application.
            }

            return json;
        }

        // Parses the data to the list
        private void parseData(dynamic ahData)
        {
            if(sql.CheckIfTimestampAlreadyProcessed(timestamp))
            {
                Logger.Write(LogType.INFO, string.Format("AuctionData timestamp {0} is already processed. Exiting..", timestamp));
                Environment.Exit(0);
            }

            long auctionId;
            long itemId;
            long bid;
            long buyout;
            long quantity;

            string owner;
            string realm;

            Logger.Write(LogType.INFO, "Starting to parse the data for database.");

            foreach(JObject stuff in ahData["auctions"])
            {
                try
                {
                    auctionId = long.Parse(stuff["auc"].ToString());
                    itemId = long.Parse(stuff["item"].ToString());
                    owner = stuff["owner"].ToString();
                    realm = stuff["ownerRealm"].ToString();
                    bid = long.Parse(stuff["bid"].ToString());
                    buyout = long.Parse(stuff["buyout"].ToString());
                    quantity = long.Parse(stuff["quantity"].ToString());

                    _items.Add(new AhItem(auctionId, itemId, owner, realm, bid, buyout, quantity));
                }
                catch (Exception ex)
                {
                    Logger.Write(LogType.ERROR, "Unable to parse item " + stuff["item"].ToString() + ": " + ex.Message);
                    continue;
                }
            }

            Logger.Write(LogType.INFO, "Parsed " + _items.Count + " items. Auctiondata timestamp: " + dateFromUnix(timestamp));
        }



    }
}
