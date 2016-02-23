using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace AuctionData.WowAPI
{
    class QueryItem
    {
        // Get item info fron blizzard http api and convert it to WowItem
        public WowItem getItemFromBlizzard(long id)
        {
            string itemJsonString;

            try
            {
                using (WebClient wc = new WebClient())
                {
                    itemJsonString = wc.DownloadString(Config.GetString("itemqueryurl") + id.ToString() + "?apikey=" + Config.GetString("apikey"));
                }
            }
            catch (WebException ex)
            {
                Logger.Write(LogType.ERROR, "Unable to download item " + id.ToString() + " information from battle.net: " + ex.Message);
                return null;
            }

            try
            {
                JObject jObject = (JObject)JsonConvert.DeserializeObject(itemJsonString);
                return new WowItem(long.Parse(
                    jObject["id"].ToString()), 
                    jObject["name"].ToString(), 
                    jObject["description"].ToString(), 
                    jObject["itemClass"].ToString(), 
                    jObject["itemSubClass"].ToString());

            }
            catch (JsonException ex)
            {
                Logger.Write(LogType.ERROR, "Unable to parse battle.net item json for item " + id.ToString() + ": " + ex.Message);
                return null;
            }

        }


    }
}
