using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData
{
    public static class Config
    {
        private static string[] configData;

        private static readonly string settingsFile = "auctiondata.cfg";

        public static void CheckConfig()
        {
            if(File.Exists(settingsFile))
            {
                try
                {
                    configData = File.ReadAllLines(settingsFile, Encoding.UTF8);
                }
                catch (IOException ex)
                {
                    Logger.Write(LogType.FATAL, "Unable to read configuration file: " + ex.Message);
                }
                
            }
            else
            {
                Logger.Write(LogType.FATAL, "Configuration file doesn't exist. Can not run.");
            }
        }

        // Get string from settings
        public static string GetString(string name)
        {
            string val = null;

            try
            {
                foreach(string data in configData)
                {
                    string[] values = data.Split(new char[] { '=' }, StringSplitOptions.None);
                    values[0] = values[0].Trim(new char[] { ' ' }); // Remove any spaces in key
                    if (values[0].Equals(name, StringComparison.InvariantCultureIgnoreCase)) // Ignore casetype
                    {
                        val = (values[1].Trim() == "" ? "" : val = values[1].Replace("\"", "").Trim());

                        // Remove comments
                        int index = val.IndexOf("#");
                        if (index > 0)
                            val = val.Substring(0, index);
                    }
                        

                }
            }
            catch
            {
                Logger.Write(LogType.ERROR, "Could not get following setting: " + name);
            }

            return val;
        }

        // Get int from settings
        public static int GetInt(string name)
        {
            string val = null;

            try
            {
                foreach (string data in configData)
                {
                    string[] values = data.Split(new char[] { '=' }, StringSplitOptions.None);
                    if (values[0].StartsWith(name, StringComparison.InvariantCulture))
                        val = (values[1].Trim() == "" ? "" : val = values[1].Replace("\"", "").Trim());
                }
            }
            catch
            {
                Logger.Write(LogType.ERROR, "Could not get following setting: " + name);
            }

            return Convert.ToInt32(val);
        }



    }
}
