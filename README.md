## What is WoWAH Project ##

WoWAH is a unfinished university programming project where we must use big data somehow. WoWAH is a combination of a C# server
application and a PHP website. Idea is to get World of Warcraft Auction House data from single Realm, query
Blizzard API for item informations, store all of it into database and show it on the website in various ways.

## WOWAH Usage ##

You must create a config file with following information:
```
# Skips some fatal exits and ignores autoclose
debug = false

# Don't query Blizzard Web Api for new items
# NOTE: Brokes sql relation rules if they are set.
$ignoreNewItemQueries = false

logToConsole = true

dbhost = "localhost"
dbport = 3306
dbuser = ""
dbpass = ""
dbname = ""

### World of Warcraft API Configuration
apikey = ""
apiurl = "https://eu.api.battle.net/wow/auction/data/"

### Battle.net API Configuration
itemqueryurl = "http://eu.battle.net/api/wow/item/"

### World of Warcraft Realm Configuration
realm = "Ravencrest"
realmlocale = "en_GB"
```

Also you must create a database with following structure:

```sql
    CREATE TABLE IF NOT EXISTS `auctions` (
  `auctionId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `realm` varchar(255) NOT NULL,
  `bid` bigint(20) NOT NULL,
  `buyout` bigint(20) NOT NULL,
  `ppu_bid` bigint(20) NOT NULL,
  `ppu_buyout` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  UNIQUE KEY `auctionId` (`auctionId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    CREATE TABLE IF NOT EXISTS `items` (
  `itemId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` int(11) NOT NULL,
  `subClass` int(11) NOT NULL,
  UNIQUE KEY `itemId` (`itemId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    CREATE TABLE IF NOT EXISTS `pulls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unixtime` int(11) NOT NULL,
  `auctions` int(11) NOT NULL,
  `newItems` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

    CREATE TABLE IF NOT EXISTS `unknown` (
  `itemId` int(11) NOT NULL,
  UNIQUE KEY `itemId` (`itemId`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

