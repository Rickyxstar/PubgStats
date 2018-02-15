# pubgtracker.com's api is down
```
Api is disabled due to throttling we are getting from Bluehole.  Please do not contact us, we will re-enable the API as soon as it's possible. We're sorry for any trouble this has caused, but it's outside of our control.
```
This is error code #3. You'll get this on all api calls for the time being. I'll test this once a week and remove this message once its up again. 

# pubgtracker.com php api

A simple wrapper for Tracker Network's api

# Installation

Install with with Composer
```bash
composer require rickyxstar/pubgstats
```

# Basic Useage

Retrieving stats. You can get an api key under "Authentication" [here](https://pubgtracker.com/site-api). 
```php
require_once 'vendor/autoload.php';

Use Rickyxstar\PubgStats;

$pubgStats = new PubgStats("YOUR-API-KEY");
$profile = $pubgStats->getProfile("Rickyxstar");

print_r($profile->stats);
```

Navigating stat array
```php
$profile->stats["REGION"]["SEASON"]["MODE"]->STATISTIC
```

If you'd like to get the user's KDR in Squad FPP for season 5 in North America
```php
$pubgStats = new PubgStats("YOUR-API-KEY");
$profile = $pubgStats->getProfile("Rickyxstar");

echo $profile->stats["na"]["2017-pre6"]["squad-fpp"]->KillDeathRatio;
```

# Retrieving specific stats

`$pubgStats->getProfile()` doesnt pull all the stats. If you find stats are missing you may need to refine your search. You can do this with the options array.
```php
$pubgStats = new PubgStats("YOUR-API-KEY");
$profile = $pubgStats->getProfile("Rickyxstar", array(
    "region" => "na",
    "season" => "2017-pre5"
    "mode" => "duo-fpp"
));
```

Your options are as follows
Seasons
`2017-pre1` `2017-pre2` `2017-pre3` `2017-pre4` `2017-pre5` `2017-pre6`

Regions
`na` `eu` `as` `oc` `sa` `sea` `krjp`

Modes
`solo` `duo` `squad` `solo-fpp` `duo-fpp` `squad-fpp`

# Lookup PUBG nickname by Steam ID

```php
$pubgStats = new PubgStats("YOUR-API-KEY");

$profile = $pubgStats->getProfileBySteamID("76561198190721251");

echo $profile->nickname;

```

`$pubgStats->getProfileBySteamID()` does not pull stats

# Get match history

To get match history you'll need the user's account ID. We can get this with thier profile.
```php
$pubgStats = new PubgStats("YOUR-API-KEY");

$profile = $pubgStats->getProfileBySteamID("76561198190721251");

//this also works
//$profile = $pubgStats->$pubgStats->getProfile("Rickyxstar");

$matches = $pubgStats->getMatchHistory($profile->accountId);

foreach($matches as $match) {
    echo $match->kills;
}
```

# Example Objects 
Profile Object 
```php

Rickyxstar\UserProfile Object
(
    [pubgTrackerId] => 622751
    [accountId] => account.2b4f5069cdc64bc483ecb3fa0ca78816
    [platform] => 4
    [nickname] => Rickyxstar
    [avatar] => https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/50/5095453b99dbec2f4506f401a80e14d7a0e05e38.jpg
    [steamId] => 76561198190721251
    [lastUpdated] => 2017-12-19T20:19:55.6327989Z
    [timePlayed] => 13105
    [raw_stats] => array (
        //LAGE ARRAY FULL OF HARD TO READ STATS. 
        //IF YOU WANT TO KNOW WHATS IN HERE, print_r($profile->raw_stats)
    )
    [stats] => Array
        (
            [na] => Array
                (
                    [2017-pre6] => Array
                        (
                            [squad-fpp] => stdClass Object
                                (
                                    [KillDeathRatio] => 0.75
                                    [WinRatio] => 0
                                    [TimeSurvived] => 5546.09
                                    [RoundsPlayed] => 4
                                    [Wins] => 0
                                    [WinTop10Ratio] => 0
                                    [Top10s] => 3
                                    [Top10Ratio] => 75
                                    [Losses] => 4
                                    [Rating] => 1290
                                    [BestRating] => 1290.29
                                    [BestRank] => 127298
                                    [DamagePg] => 163.95
                                    [HeadshotKillsPg] => 0.25
                                    [HealsPg] => 0.5
                                    [KillsPg] => 0.75
                                    [MoveDistancePg] => 4959.79
                                    [RevivesPg] => 0.5
                                    [RoadKillsPg] => 0
                                    [TeamKillsPg] => 0
                                    [TimeSurvivedPg] => 1386.52
                                    [Top10sPg] => 0.75
                                    [Kills] => 3
                                    [Assists] => 2
                                    [Suicides] => 0
                                    [TeamKills] => 0
                                    [HeadshotKills] => 1
                                    [HeadshotKillRatio] => 0.33
                                    [VehicleDestroys] => 0
                                    [RoadKills] => 0
                                    [DailyKills] => 1
                                    [WeeklyKills] => 1
                                    [RoundMostKills] => 1
                                    [MaxKillStreaks] => 1
                                    [WeaponAcquired] => 0
                                    [Days] => 3
                                    [LongestTimeSurvived] => 1887.46
                                    [MostSurvivalTime] => 1887.46
                                    [AvgSurvivalTime] => 1386.52
                                    [WinPoints] => 1079
                                    [WalkDistance] => 8079.61
                                    [RideDistance] => 11759.56
                                    [MoveDistance] => 19839.17
                                    [AvgWalkDistance] => 2019.9
                                    [AvgRideDistance] => 2939.89
                                    [LongestKill] => 97.79
                                    [Heals] => 2
                                    [Revives] => 2
                                    [Boosts] => 4
                                    [DamageDealt] => 655.81
                                    [DBNOs] => 2
                                )

                        )

                )
            //I THINK THESE ARE AVERAGES...
            [agg] => Array
                (
                    [2017-pre6] => Array
                        (
                            [squad-fpp] => stdClass Object
                                (
                                    [KillDeathRatio] => 0.75
                                    [WinRatio] => 0
                                    [TimeSurvived] => 5546.09
                                    [RoundsPlayed] => 4
                                    [Wins] => 0
                                    [WinTop10Ratio] => 0
                                    [Top10s] => 3
                                    [Top10Ratio] => 75
                                    [Losses] => 4
                                    [Rating] => 1290
                                    [BestRating] => 1290.29
                                    [BestRank] => 0
                                    [DamagePg] => 163.95
                                    [HeadshotKillsPg] => 0.25
                                    [HealsPg] => 0.5
                                    [KillsPg] => 0.75
                                    [MoveDistancePg] => 4959.79
                                    [RevivesPg] => 0.5
                                    [RoadKillsPg] => 0
                                    [TeamKillsPg] => 0
                                    [TimeSurvivedPg] => 1386.52
                                    [Top10sPg] => 0.75
                                    [Kills] => 3
                                    [Assists] => 2
                                    [Suicides] => 0
                                    [TeamKills] => 0
                                    [HeadshotKills] => 1
                                    [HeadshotKillRatio] => 0.33
                                    [VehicleDestroys] => 0
                                    [RoadKills] => 0
                                    [DailyKills] => 1
                                    [WeeklyKills] => 1
                                    [RoundMostKills] => 1
                                    [MaxKillStreaks] => 1
                                    [WeaponAcquired] => 0
                                    [Days] => 3
                                    [LongestTimeSurvived] => 1887.46
                                    [MostSurvivalTime] => 1887.46
                                    [AvgSurvivalTime] => 1386.52
                                    [WinPoints] => 1079
                                    [WalkDistance] => 8079.61
                                    [RideDistance] => 11759.56
                                    [MoveDistance] => 19839.17
                                    [AvgWalkDistance] => 2019.9
                                    [AvgRideDistance] => 2939.89
                                    [LongestKill] => 97.79
                                    [Heals] => 2
                                    [Revives] => 2
                                    [Boosts] => 4
                                    [DamageDealt] => 655.81
                                    [DBNOs] => 2
                                )

                        )

                )

        )

)
```

Match Object
```php
    stdClass Object
        (
            [id] => 14787371
            [updated] => 2017-11-09T04:04:22.797
            [updatedJS] => 1510200262797
            [season] => 5
            [seasonDisplay] => Early Access Season #5
            [match] => 5
            [matchDisplay] => FP Duo
            [region] => 1
            [regionDisplay] => [NA] North America
            [rounds] => 9
            [wins] => 0
            [kills] => 23
            [assists] => 3
            [top10] => 3
            [rating] => 1348.9
            [ratingChange] => 1348.9
            [ratingRank] => 94815
            [ratingRankChange] => 94815
            [headshots] => 0
            [kd] => 2.56
            [damage] => 2847
            [timeSurvived] => 8256.48
            [winRating] => 1099
            [winRank] => 121954
            [winRatingChange] => 1099
            [winRatingRankChange] => 121954
            [killRating] => 1248
            [killRank] => 33878
            [killRatingChange] => 1248
            [killRatingRankChange] => 33878
            [moveDistance] => 16533.66
        )

```