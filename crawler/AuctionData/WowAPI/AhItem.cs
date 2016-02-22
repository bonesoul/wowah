using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AuctionData.WowAPI
{
    class AhItem
    {

        private long _auctionId;
        private long _itemId;

        private string _owner;
        private string _realm;

        private long _bid;
        private long _buyout;
        private long _quantity;

        public long AuctionID
        {
            get { return _auctionId; }
        }

        public long ItemID
        {
            get { return _itemId; }
        }

        public string Owner
        {
            get { return _owner; }
        }

        public string Realm
        {
            get { return _realm; }
        }

        public long Bid
        {
            get { return _bid; }
        }

        public long Buyout
        {
            get { return _buyout; }
        }

        public long Quantity
        {
            get { return _quantity; }
        }

        public long PricePerUnitBuyout
        {
            get { return Buyout / Quantity; }
        }

        public long PricePerUnitBid
        {
            get { return Bid / Quantity; }
        }


        public AhItem(long auctionId, long itemId, string owner, string realm, long bid, long buyout, long quantity)
        {
            _auctionId = auctionId;
            _itemId = itemId;
            _owner = owner;
            _realm = realm;
            _bid = bid;
            _buyout = buyout;
            _quantity = quantity;
        }
    }
}
