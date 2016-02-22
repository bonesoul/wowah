using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace AuctionData.Database
{
    class DbConnector : IDisposable
    {
        private enum State
        {
            Disconnected,
            Open,
            Error
        }

        private State state;

        public string ConnectionState
        {
            get
            {
                switch(state)
                {
                    default:
                    case State.Error:
                        return "Error";

                    case State.Open:
                        return "Open";
                    case State.Disconnected:
                        return "Disconnected";
                }
            }
        }

        private void initializeDatabase()
        {
            if(state == State.Open)
            {

            }
        }


        private MySqlConnection sqlConn;
        private string connString;

        private WowAPI.QueryItem itemQuery;

        private List<WowAPI.WowItem> newItems;
        private List<long> newItemIds;

        public DbConnector()
        {
            Logger.Write(LogType.INFO, "Initializing DbConnector class...");

            state = State.Disconnected;



            // Check that all needed info is at config file
            if (Config.GetString("dbhost") == null || 
                Config.GetInt("dbport") == 0 || 
                Config.GetString("dbuser") == null || 
                Config.GetString("dbpass") == null || 
                Config.GetString("dbname") == null)
            {
                Logger.Write(LogType.FATAL, string.Format("Unable to initialize, some needed information couldn't be found. dbhost={0}, dbport={1}, dbuser={2}, dbpass={3}, dbname={4}",
                    Config.GetString("dbhost").Select(r => r == ' ' ? ' ' : 'X').ToArray(),
                    Config.GetInt("dbport"),
                    Config.GetString("dbuser").Select(r => r == ' ' ? ' ' : 'X').ToArray(),
                    Config.GetString("dbpass").Select(r => r == ' ' ? ' ' : 'X').ToArray(),
                    Config.GetString("dbname").Select(r => r == ' ' ? ' ' : 'X').ToArray()));
            }


            connString = String.Format("server={0};port={1};uid={2};pwd={3};database={4};", 
                Config.GetString("dbhost"), 
                Config.GetInt("dbport").ToString(), 
                Config.GetString("dbuser"), 
                Config.GetString("dbpass"), 
                Config.GetString("dbname"));

            sqlConn = new MySqlConnection(connString);

            try
            {
                sqlConn.Open();
                state = State.Open;
            }
            catch (MySqlException ex)
            {
                Logger.Write(LogType.FATAL, "Unable to open MySQL connection: " + ex.Message);
                state = State.Error;
                return;
            }

            itemQuery = new WowAPI.QueryItem();

            newItemIds = new List<long>();
            newItems = new List<WowAPI.WowItem>();

            Logger.Write(LogType.INFO, "Done.");
        }

        private void insertAhItem(WowAPI.AhItem[] items, long unixtime)
        {
            // Insert into pulls the info
            Pulls pulls = new Pulls(unixtime, newItems.Count, items.Length);

            if (pulls.Unixtime > pulls.getLastPull(sqlConn.CreateCommand()))
            {
                pulls.InsertData(sqlConn.CreateCommand());

                int itemCount = 0;
                int itemQueries = 0;

                StringBuilder sbAuctions = new StringBuilder();
                StringBuilder sbItems = new StringBuilder();

                sbAuctions.Append("INSERT IGNORE INTO auctions (auctionId, itemId, owner, realm, bid, buyout, ppu_bid, ppu_buyout, quantity) VALUES ");
                sbItems.Append("INSERT IGNORE INTO items (itemId, name, class, subClass) VALUES ");

                Logger.Write(LogType.INFO, "Creating SQL query for " + items.Length.ToString() + " auctions.");

                for (int i = 0; i < items.Length; i++)
                {



                    // Check if we are having a new item which doesn't exist in database yet
                    if (!(checkIfItemExists(items[i].ItemID)) && !(newItemIds.Contains(items[i].ItemID)))
                    {
                        newItemIds.Add(items[i].ItemID);

                        // If we want to ignore queries... Ignore :-D
                        if (Config.GetString("ignoreNewItemQueries") != "true")
                        {


                            WowAPI.WowItem newItem = itemQuery.getItemFromBlizzard(items[i].ItemID);
                            itemQueries++;

                            // If wow api doesn't know the ID, report it and skip it
                            if (newItem == null)
                                insertInvalidItemId(items[i].ItemID);
                            else
                                newItems.Add(newItem);
                        }
                        else
                            Logger.Write(LogType.WARNING, "ignoreNewItemQueries = true, ignoring Blizzard Web Api queries and not adding new items to database!");


                        if (Config.GetString("logToConsole") == "true")
                        {
                            Console.SetCursorPosition(0, Console.CursorTop);
                            Console.Write("Itemqueries from Blizzard API: " + newItems.Count.ToString());
                        }

                    }

                    sbAuctions.Append("('");
                    sbAuctions.Append(items[i].AuctionID.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("");
                    sbAuctions.Append(items[i].ItemID);
                    sbAuctions.Append(", ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].Owner.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].Realm.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].Bid.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].Buyout.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].PricePerUnitBid.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].PricePerUnitBuyout.ToString());
                    sbAuctions.Append("', ");

                    sbAuctions.Append("'");
                    sbAuctions.Append(items[i].Quantity.ToString());

                    if (items.Length - 1 == i)
                        sbAuctions.Append("');");
                    else
                        sbAuctions.Append("'), ");

                    itemCount++;

                }

                // Insert new items if any
                if (newItems.Count != 0)
                {
                    Logger.Write(LogType.INFO, "Creating SQL query for " + newItems.Count.ToString() + " new items.");

                    for (int i = 0; i < newItems.Count; i++)
                    {
                        sbItems.Append("(");
                        sbItems.Append(newItems[i].ItemID);
                        sbItems.Append(", ");

                        sbItems.Append("'");
                        sbItems.Append(newItems[i].Name);
                        sbItems.Append("', ");

                        sbItems.Append("");
                        sbItems.Append(newItems[i].Class);
                        sbItems.Append(", ");

                        sbItems.Append("");
                        sbItems.Append(newItems[i].SubClass);


                        if (newItems.Count - 1 == i)
                            sbItems.Append(");");
                        else
                            sbItems.Append("), ");
                    }
                }

                MySqlCommand sqlCommand = sqlConn.CreateCommand();

                Logger.Write(LogType.INFO, "Adding " + itemCount.ToString() + " auctions to the database.");
                sqlCommand.CommandText = sbAuctions.ToString();


                try
                {
                    sqlCommand.ExecuteNonQuery();
                }
                catch (MySqlException ex)
                {
                    // Packet too big, max_allowed_packet
                    if (ex.Number == 1153)
                    {
                        Logger.Write(LogType.FATAL, "Unable to insert query of size " + sqlCommand.CommandText.Length + " to database. Make sure to set max_allowed_packet high enough from my.ini.");
                    }
                    else
                    {
                        Logger.Write(LogType.ERROR, "Unable to insert auctions to database: " + ex.Message);
                    }
                }
                finally
                {
                    sqlCommand.Dispose();
                }


                if (newItems.Count != 0)
                {
                    Logger.Write(LogType.INFO, "Adding " + newItems.Count.ToString() + " new items to the database.");

                    try
                    {
                        sqlCommand = sqlConn.CreateCommand();
                        sqlCommand.CommandText = sbItems.ToString();
                        sqlCommand.ExecuteNonQuery();
                    }
                    catch (MySqlException ex)
                    {
                        Logger.Write(LogType.ERROR, "Unable to add new items to database: " + ex.Message);
                    }
                    finally
                    {
                        sqlCommand.Dispose();
                    }

                }
                else
                {
                    Logger.Write(LogType.INFO, "No new items.");
                }
            }
            else
            {
                Logger.Write(LogType.WARNING, string.Format("Auctiondata timestamped {0} is already added to database. Not adding twice.", pulls.Unixtime));
            }



            



            

            


            


            
        }

        private void insertInvalidItemId(long itemID)
        {
            try
            {
                MySqlCommand sqlCommand = sqlConn.CreateCommand();
                sqlCommand.CommandText = "INSERT IGNORE INTO unknown (itemId) VALUES (@itemid)";
                sqlCommand.Parameters.AddWithValue("@itemid", itemID);
                sqlCommand.ExecuteNonQuery();
            }
            catch (MySqlException ex)
            {
                Logger.Write(LogType.ERROR, "Unable to insert invalid item " + itemID.ToString() + " to database: " + ex.Message);
                return;
            }
        }


        // Checks if item exists already in db.items
        // Returns true/false
        private bool checkIfItemExists(long id)
        {
            string itemExists = String.Empty;
            MySqlDataReader sqlReader = null; 

            try
            {
                MySqlCommand sqlCommand = sqlConn.CreateCommand();
                sqlCommand.CommandText = "SELECT EXISTS(SELECT * FROM items WHERE itemId = " + id + ")";

                sqlReader = sqlCommand.ExecuteReader();

                while (sqlReader.Read())
                    itemExists = sqlReader.GetString(0);

                sqlReader.Close();
                sqlReader.Dispose();

                if (itemExists == "1")
                    return true;
                return false;
            }
            catch (MySqlException ex)
            {
                Logger.Write(LogType.ERROR, "Unable to check id " + id.ToString() + " from database: " + ex.Message);

                if(sqlReader != null)
                {
                    sqlReader.Close();
                    sqlReader.Dispose();
                }

                return false;
            }
        }

        public void Dispose()
        {
            if(sqlConn != null)
            {
                sqlConn.Close();
                sqlConn.Dispose();
            }

            state = State.Disconnected;
        }

        public void insertAhData(WowAPI.AhItem[] items, long unixtime)
        {
            if(state != State.Open)
            {
                Logger.Write(LogType.ERROR, "Tried to insert items to DB but the connection isn't opened or errored!");
                return;
            }

            Logger.Write(LogType.INFO, "Preparing SQL module for inserting data.");
            insertAhItem(items, unixtime);

            Logger.Write(LogType.INFO, "All data inserted.");
        }

        public bool CheckIfTimestampAlreadyProcessed(long timestamp)
        {
            Pulls pulls = new Pulls(timestamp, 0, 0);
            if (pulls.Unixtime > pulls.getLastPull(sqlConn.CreateCommand()))
                return false;
            return true;
        }
    }
}
