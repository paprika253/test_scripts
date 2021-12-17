const WebSocket = require("ws");
const sqlite3 = require('sqlite3').verbose();

var config = require('./config.json');
var myArgs = process.argv.slice(2);
var ws_data = getWSDataFromArgs(myArgs[0])

const connection = new WebSocket(ws_data.get('url'))

connection.onopen = () => {
    connection.send(ws_data.get('message'));
    console.log("sended message: " + ws_data.get('message'));
    console.log("bye!");
    process.exit(1)
}

/**
 * Determine the type of script execution 
 * and stop the process if nothing is specified
 */
function getWSDataFromArgs(argument) 
{
    var db = new sqlite3.Database('database.sqlite');
    var result = new Map()
    
    switch (argument) {
        case 'first_message':
            result.set('url', config.first_slave_ws)
            result.set('message', "message: " + argument)
         
            return result
        case 'second_message':
            result.set('url', config.second_slave_ws)
            result.set('message', "message: " + argument)
            
            return result
        case 'third_message':
            result.set('url', config.third_slave_ws)
            result.set('message', "message: " + argument)
            
            return result
        case 'first_perm':
            var data = []

            db.each("SELECT value FROM permissions WHERE slave=" + argument, function(err, row) {
                data.push(row)
            });
            db.close();

            result.set('url', config.first_slave_ws)
            result.set('message', "permission: " + data)
                
            return result
        case 'second_perm':
            var data = []

            db.each("SELECT value FROM permissions WHERE slave=" + argument, function(err, row) {
                data.push(row)
            });
            db.close();

            result.set('url', config.second_slave_ws)
            result.set('message', "permission: " + data)
                    
            return result
        case 'third_perm':
            var data = []

            db.each("SELECT value FROM permissions WHERE slave=" + argument, function(err, row) {
                data.push(row)
            });
            db.close();

            result.set('url', config.third_slave_ws)
            result.set('message', "permission: " + data)
                    
            return result
        case 'first_command':
            result['url'] = config.first_slave_ws
            result.set('message', "command: start")
                    
            return result
        case 'second_command':
            result.set('url', config.second_slave_ws)
            result.set('message', "command: start")

            return result
        case 'third_command':
            result.set('url', config.third_slave_ws)
            result.set('message', "command: start")
                    
            return result
        default:
            console.log("there is no such command. kill");
            process.exit(1)
        }
}