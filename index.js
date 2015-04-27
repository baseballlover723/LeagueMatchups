"use strict";
var KEYS = ["f5c821d7-fc96-47f3-914d-7026a8525eee"];
var CHAMP_REQUEST = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=image,tags&api_key=";
var CHAMP_IMG_URL = "http://ddragon.leagueoflegends.com/cdn/5.2.1/img/champion/";

var ITEM_REQUEST = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/item?itemListData=image&api_key=";
var ITEM_IMG_URL = "http://ddragon.leagueoflegends.com/cdn/5.2.1/img/item/";

function addChamps() {
    console.log("hit addChamps");
    $.ajax({
        type: "POST",
        url: "addChamp.php",
        async: false,
        data: "method=resetFile",
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            console.log("resetFile " + XMLHTTPRequest.responseText);
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            console.log("Success, reset file ");
        }
    });

    $.ajax({
        type: "GET",
        url: CHAMP_REQUEST + KEYS[0],
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            console.log("error " + XMLHTTPRequest.responseText);
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            for (var champ in ajax["data"]) {
                champ = ajax["data"][champ];
                addChampToDatabase(champ);
            }
        }
    });
}

function addChampToDatabase(champ) {
    var id = champ["id"];
    var name = champ["name"];
    var title = champ['title'];
    var primaryRole = champ["tags"][0];
    var secondaryRole = champ["tags"][1];
    var imageURL = CHAMP_IMG_URL + champ["image"]["full"];

    var response = $.ajax({
        type: "POST",
        url: "addChamp.php",
        data: "id=" + id + "&name=" + name + "&title=" + title + "&primaryRole=" + primaryRole + "&secondaryRole=" + secondaryRole+"&imageURL="+imageURL,
        async: false,
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            console.log("error " + XMLHTTPRequest.responseText);
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            console.log("done with php script, returned *" + ajax + "*");
        }
    });

    //console.log("name = " + name + ", id = " + id + ", title = " + title + ", primary role = " + primaryRole + ", secondary role = " + secondaryRole);
}

function addItems() {
    console.log("hit add items");
    $.ajax({
        type: "POST",
        url: "addItem.php",
        async: false,
        data: "method=resetFile",
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            console.log("resetFile " + XMLHTTPRequest.responseText);
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            console.log("Success, reset file ");
        }
    });

    $.ajax({
        type: "GET",
        url: ITEM_REQUEST + KEYS[0],
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            fail(XMLHTTPRequest, textStatus, errorThrown, "names", "#loadingnames");
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            for (var item in ajax["data"]) {
                item = ajax["data"][item];
                addItemToDatabase(item);
                //console.log(item);
            }
        }
    });
}

function addItemToDatabase(item) {
    var id = item["id"];
    var name = item["name"];
    var description = item["description"];
    var imageURL = ITEM_IMG_URL + item["image"]["full"];
    //console.log("\nid = " + id);
    //console.log("name = " + name);
    //console.log("description = " + description);
    //console.log("imageURL = " + imageURL);
    $.ajax({
        type: "POST",
        url: "addItem.php",
        async: false,
        data: "id=" + id + "&name=" + name + "&description=" + description + "&imageURL=" + imageURL,
        error: function (XMLHTTPRequest, textStatus, errorThrown) {
            console.log("error " + XMLHTTPRequest.responseText);
        },
        success: function (ajax, textStatus, XMLHTTPRequest) {
            console.log("done with php script, returned *" + ajax + "*");
        }
    });

}
