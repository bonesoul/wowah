using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData.Database
{
    class Pulls
    {
        private long unixtime;
        private int newItems;
        private int auctions;

        public bool sameDate(long unixtime)
        {
            if (unixtime == this.unixtime)
                return true;
            return false;
        }

        public long Unixtime
        {
            get
            {
                return unixtime;
            }
        }

        public Pulls(long unixtime, int newItems, int auctions)
        {
            this.unixtime = unixtime;
            this.newItems = newItems;
            this.auctions = auctions;
        }

        public void InsertData(MySqlCommand sqlComm)
        {
            sqlComm.CommandText = string.Format("INSERT INTO pulls (unixtime, auctions, newItems) VALUES ('{0}', '{1}', '{2}');", unixtime, auctions, newItems);

            try
            {
                sqlComm.ExecuteNonQuery();
            }
            catch (MySqlException ex)
            {
                Logger.Write(LogType.ERROR, string.Format("Unable to query [{0}] into 'pulls' table: {1}", sqlComm.CommandText , ex.Message));
            }
            finally
            {
                sqlComm.Dispose();
            }
            
        }

        public long getLastPull(MySqlCommand sqlComm)
        {
            string time = String.Empty;

            sqlComm.CommandText = "SELECT MAX(unixtime) FROM pulls";
            MySqlDataReader reader = null;

            try
            {
                reader = sqlComm.ExecuteReader();

                while (reader.Read())
                {
                    if (reader.IsDBNull(0))
                        time = "0";
                    else
                        time = reader.GetString(0);
                }

                


            }
            catch (MySqlException ex)
            {
                Logger.Write(LogType.ERROR, "Unable to get newest date from pulls table: " + ex.Message);
                return 0;
            }
            finally
            {
                if (reader != null)
                {
                    reader.Close();
                    reader.Dispose();
                }
                    
            }

            if (time != string.Empty)
                return long.Parse(time);
            else
                return 0;

        }

    }
}
