using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData
{
    class Program
    {
        static void Main(string[] args)
        {
            // Start logging
            Logger.Write(LogType.INFO, "", true);

            // Load configuration
            Logger.Write(LogType.INFO, "Checking configuration file");
            Config.CheckConfig();

            // Load DB class
            Database.DbConnector sql = new Database.DbConnector();

            // Load AuctionHouse
            WowAPI.QueryAh ah = new WowAPI.QueryAh(sql);

            // Get new AH data
            ah.getNewData();

            // Insert data to DB if there is something available
            if (ah.DataAvailable)
                sql.insertAhData(ah.Items, ah.Timestamp);


            Logger.Write(LogType.INFO, "Everything is done. Exiting.");


        }
    }
}
