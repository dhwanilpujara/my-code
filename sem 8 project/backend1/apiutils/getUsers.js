const sql = require("mssql");
const con = require("../dbConfig");

async function getUserDetail(res, req){
    const UserId = req.header("token");
    try {
        await sql.connect(dbConfig);
    
        const request = new sql.Request();
        request.input("UserId", sql.Int, UserId);
    
        const result = await request.execute("GetUser");
    
        console.log("Result", result);
    
        if (result.recordset.length === 0) {
          console.log("No records found");
          return res.status(200).json(result.recordset);
        }
    
        console.log("Stored procedure result:", result.recordset);
    
        return res.status(200).json(result.recordset);
      } catch (error) {
        console.error("Error:", error.message);
        return res.status(500).json({ error: "Internal server error" });
      }
}

module.exports = getUserDetail;