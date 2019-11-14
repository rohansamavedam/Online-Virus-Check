# Online-Virus-Check
Web based antivirus application that allows user to upload a file and check if its contents are malicious.

Definitions:

Infected File: It is a File that contains a Virus.
Putative Infected File: It is a File that might contain the Virus and needs to go under analysis.


Allows the user to submit a putative infected file and shows if it is infected or not.
Athenticate an Admin and allows him/her to submit a Malware file, plus the name of the uploaded Malware (ex, Winwebsec).


Reads a file uploaded in input by an Admin, per bytes, and stores a sequence of bytes from the file, say, the first 20 bytes (signature), in a database (Note: an Admin uploads only Malware files).
Reads a file uploaded by a normal user in input, per bytes, and searches within the file for one of the strings stored in the database (Note: a normal user will always upload putative infected files).
 
MySQL database:

Stores the information regarding the infected files in input, such as name of the malware (not the name of the file) and the sequence of bytes
Stores the information related to the Admin with username and password, in the most secure way of your knowledge.

 
