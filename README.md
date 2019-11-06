# Online-Virus-Check
Web based antivirus application that allows user to upload a file and check if its contents are malicious.

The idea is to create a web-based Antivirus application that allows the users to upload a file (of any type) to check if it contains malicious content. That is, if it is a Malware or not.

Definitions:

Infected File: It is a File that contains a Virus.
Putative Infected File: It is a File that might contain the Virus and needs to go under analysis.
 

You will have to:

Build a web page that:

Allows the user to submit a putative infected file and shows if it is infected or not.
Lets authenticate an Admin and allows him/her to submit a Malware file, plus the name of the uploaded Malware (ex, Winwebsec).
 

Build a web application that:

Reads a file uploaded in input by an Admin, per bytes, and stores a sequence of bytes from the file, say, the first 20 bytes (signature), in a database (Note: an Admin uploads only Malware files).
Keep in mind that, based on the type of file, the first 20 Bytes might not be very informative. In fact, they are usually used by the header (basically saying which kind of file it is).
Reads a file uploaded by a normal user in input, per bytes, and searches within the file for one of the strings stored in the database (Note: a normal user will always upload putative infected files).
 

Build a MySQL database that:

Stores the information regarding the infected files in input, such as name of the malware (not the name of the file) and the sequence of bytes
Stores the information related to the Admin with username and password, in the most secure way of your knowledge.
  

If your group is formed by two or three people, you have to add these requirements:

The website will let register a user to the website as a Contributor, asking for username, email and password.
When a registered user, that is, a Contributor, logs in on the website, s/he can upload a Malware file and the relative signature is stored in a different table than the one containing the actual Malware information. This new table contains putative malware that must be double-checked by an Admin.
Thus, when an Admin logs in, the application should allow the Admin to visualize the content of such table and, if prompted, to move selected records from this table to the one containing the actual Malware information.
 
