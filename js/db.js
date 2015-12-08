var DocumentClient = require("documentdb").DocumentClient;

var endpoint = "https://punterestdb.documents.azure.com:443/";
var authKey = "OLt4wIsQCEIvVt3SX4JBDybvreUDIrfJJV+6S/eDHKepVWp9X+zJd1ygIqVmDxhSBw2ntUCMbf2iZKTleTqF8w==";

var client = new DocumentClient(endpoint, {"masterKey": authKey} );

var databaseDefinition = {"id": "bleep"};
var collectionDefinition = {"id": "bloop"};
var documentDefinition = {
    "id": "blaap",
    "bibbidi": {
        "bobbidi": "boo"
    }
}

client.createDatabase(databaseDefinition, function(err, database) {
    client.createCollection(database._self, collectionDefinition, function(err, collection) {
        client.createDocument(collection._self, documentDefinition, function(err, document) {
            client.queryDocuments(collection._self, "SELECT * FROM docs d WHERE d.bibbidi.bobbidi = 'boo'").toArray(function(err, results) {
                console.log("Query Results:");
                console.log(results);
            });
        });
    });
});
