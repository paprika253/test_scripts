const sqlite3 = require('sqlite3').verbose();

var db = new sqlite3.Database('database.sqlite');

db.serialize(function() {
    db.run("CREATE TABLE permissions (value TEXT, slave TEXT)");
  
    var stmt = db.prepare("INSERT INTO permissions VALUES (?)");
    stmt.run("read", "first");
    stmt.run("read", "second");
    stmt.run("read", "third");
    stmt.finalize();

  });
  
db.close();