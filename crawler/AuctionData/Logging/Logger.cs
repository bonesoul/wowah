using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData
{

    public enum LogType
    {
        [Description("INFO")]
        INFO,
        [Description("WARNING")]
        WARNING,
        [Description("ERROR")]
        ERROR,
        [Description("FATAL")]
        FATAL
    }

    

    public static class Logger
    {
        // Log file
        private static readonly FileInfo logFile = new FileInfo("AuctionData.log");


        /* Checks if config file exists, if not then create it. 
         * Then if file is not locked, append text to it.
         * Also if type is fatal, end the process.
         */
        public static void Write(LogType type, string message = "", bool startTime = false)
        {

            // Check if file exists, if not then create it.
            try
            {
                if (!logFile.Exists)
                    logFile.Create();

                
            }
            catch (Exception ex)
            {
                Console.WriteLine("FATAL: Could not find nor create a log file: {0}", ex.Message);
                Environment.Exit(1);
            }

            

            if (!isConfigLocked())
            {
                // Get time
                string time = DateTime.Now.ToString();

                // Get enum desc
                DescriptionAttribute[] attributes = (DescriptionAttribute[])type.GetType().GetField(type.ToString()).GetCustomAttributes(typeof(DescriptionAttribute), false);
                string logtype = attributes.Length > 0 ? attributes[0].Description : string.Empty;

                
                // Append text
                try
                {
                    using (StreamWriter sw = logFile.AppendText())
                    {
                        if (startTime)
                        {
                            sw.WriteLine("");
                            sw.WriteLine();

                            if (Config.GetString("logToConsole") == "true")
                                Console.WriteLine("# Program started at " + time);
                        }
                        else
                        {
                            sw.WriteLine(time + " - " + logtype + " - " + message);

                            if (Config.GetString("logToConsole") == "true")
                                Console.WriteLine(time + " - " + logtype + " - " + message);
                        }

                        

                    }
                }
                catch (IOException ex)
                {
                    Console.WriteLine("WARNING: Unable to append text into log file: {0}", ex.Message);
                }

            }

            if (type == LogType.FATAL)
            {
                if ((Config.GetString("debug") == "true"))
                {
                    Console.WriteLine("CRITICAL ERROR - SHOULD EXIT");
                    Console.Read();
                }
                else
                {
                    Environment.Exit(1);
                }
            }
                
                

            
        }


        // Checks if file is locked. Returns true/false
        private static bool isConfigLocked()
        {

            FileStream stream = null;
            bool locked = false;

            try
            {
                stream = logFile.Open(FileMode.Open, FileAccess.Read, FileShare.None);
            }
            catch (IOException)
            {
                locked = true;
            }
            finally
            {
                if (stream != null)
                {
                    stream.Close();
                    stream.Dispose();
                }
                    
            }


            return locked; 
        }
        
    }
}
