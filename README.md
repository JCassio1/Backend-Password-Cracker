# A Simple backend password cracker

This is a test you a password cracker tool. There are 22 passwords to find, 12 are dictionary words, 4 are numbers, 4 are 3 lowercase characters strings with a number at the end, and Two are 6 character length string made up of Upper, Lowercase and Numbers.

<p align="center">
  <img src="https://github.com/JCassio1/Backend-Password-Cracker/blob/main/Assets/Video.gif" />
</p>

## 🚀 Tech

<div>
<img src="https://logos-download.com/wp-content/uploads/2016/09/PHP_logo.png" width="5%" height="5%"> PHP
</div>


## ✋🏻 Pre-requisites

- [Terminal](https://www.youtube.com/watch?v=5XgBd6rjuDQ)
- [Local Server environment: MAMP, XAMPP](https://www.youtube.com/watch?v=Zo5gGr0DWhg)
- [MYSQL](https://www.youtube.com/watch?v=-BDbOOY9jsc)


## 🔥 Install & Execute

1. Clone the repo;
2. Open the cloned repo;
3. Run Local server environment. i.e XAMPP, MAMP, MAMP Pro
4. Import [SQL instructions](https://github.com/JCassio1/Backend-Password-Cracker/blob/main/helpers/not_so_smart_users.sql.txt) file to PhpMyAdmin
5. Add 3 support [raw files](https://drive.google.com/drive/folders/1f5bXWDniLVd6idhzPSHvbo3HUsOctAvf?usp=sharing) inside folder "Main"
6. Navigate to Main folder path in terminal and execute "php passwordCracker.php"

## 🦾 Tasks
- Easy - The 4 user IDs who used 5 numbers as their passwords i.e. 12345
- Medium - The 4 user IDs who used just 3 Uppercase characters and 1 number as their password i.e. ABC1
- Medium - The 12 user IDs who used just lowercase dictionary words (Max 6 chars) as their passwords i.e. london
- Hard - The 2 user IDs who used a 6 character passwords using a mix of Upper, Lowercase and numbers i.e AbC12z 


## 🛣 Possible solutions
Solutions | Pros | Cons
| :--- | ---: | :---:
Search with regular expressins  | Extremely powerful search pattern | Passwords are not in plain text
Search with MYSQL  | Compares cracked passwords faster with search engine | DBMS can ocasionally time-out
Chunkify word and perform multiple SELECT on database  | Search is quicker than one at a time | Uses more resources and only worked with small files


## 🛣 Choosen solution

Searching directly with DBMS one word at a time. It is a more time consuming approach, however, it works with large file and returns the number of matches at the end of the search. To search for matching MD5 salted passwords in the database, word/numeric/alphanumeric values were created and appended to text files that are then used to compare.

It operates in the following way:

- Grabs text file
- Assigns text file to cracking methods
- Opens file and retrieves content line by line
- Each content goes through encryptToMD5 method to be encrypted
- Upon encryption. It is searched in the database via a query
- If there is a match, it is echoed on the screen and saved into an array
- Upon reaching the end of the file. It prints every match that was saved in the array

<p align="center">
  <img src="https://github.com/JCassio1/Backend-Password-Cracker/blob/main/Assets/flow-diagram.png" />
</p>


Made with ❤️ by Joselson
