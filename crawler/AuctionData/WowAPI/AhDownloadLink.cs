using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData.WowAPI
{
    class AhDownloadLink
    {

        private string url;
        private long timestamp;

        public string URL
        {
            get { return url; }
        }

        public long Timestamp
        {
            get { return timestamp; }
        }



        public AhDownloadLink(string url, long timestamp)
        {
            this.url = url;
            this.timestamp = timestamp;
        }

        public bool isOlder(long timestamp)
        {
            return this.timestamp < timestamp ? true : false;
        }
    }
}
