const sql = require("mysql");
const dbConfig = {
  user: "maskedvo_KoiNaa",
  password: "Hey_world55@2()",
  host: "127.0.0.1",
  database: "maskedvo_MaskedVoice",
  port: "3306",// Add this if needed based on your MySQL server configuration
};

const con = sql.createConnection(dbConfig);

con.connect(function(error){
  if(error) throw error;
  
  // con.query('select * from users',function(error, result){
  //   if(error) throw error;
  //   console.log(result);
  // });
});
// Create a new connection pool
// const pool = mysql.createPool(dbConfig);


// pool.getConnection((err, connection) => {
//   if (err) {
//     console.error("Error connecting to the database:", err);
//     return;
//   }

//   console.log("Connected Runeer.");

//   // Perform your database operations here

//   connection.release(); // Release the connection when done
// });

module.exports = con;