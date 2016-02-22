using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData.WowAPI
{
    class WowItem
    {
        private long _itemId;
        private string _name;
        private int _class;
        private int _subClass;

        public int Class
        {
            get { return _class; }
        }

        public int SubClass
        {
            get { return _subClass; }
        }

        public long ItemID
        {
            get { return _itemId; }
        }

        public string Name
        {
            get { return _name.Replace("'", "''"); }
        }




        public WowItem(long id, string name, string description, string Class, string subClass)
        {
            _itemId = id;
            _name = name;
            _class = int.Parse(Class);
            _subClass = int.Parse(subClass);
        }
    }
}
