#include <stdio.h>
#include <stdlib.h>h8uijh
#include <windows.h>
#include <winsock.h>
#include <mysql.h>
#include<conio.h>
#include<time.h>
#include<string.h>

MYSQL *conn;
 MYSQL_RES *res;
 MYSQL_RES *resultset;
 MYSQL_RES *rs;
 MYSQL_ROW row;
 MYSQL_RES *res1;
 MYSQL_RES *resultset1;
 MYSQL_RES *rs1;
 MYSQL_RES *rs2;
 MYSQL_ROW row1;
 char *server = "127.0.0.1";
 char *user = "root";
 char *password = "";
 char *database = "kindercare";
 char myquery[255];
 char request[255];
 char dates[255];
 char datenow[11];
 char usercode[20];
 time_t timenow;
 int hournow;
 int minutesnow;




 //this function fetches assignment ID and date from database
 void viewAll(){

         conn = mysql_init(0);
         MYSQL_ROW record;
         char attemptstatus[255];
          MYSQL_ROW record1;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }

         if(mysql_query(conn, "SELECT AssignmentID, Date FROM assignment")){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs = mysql_store_result(conn);
        if(rs==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        puts("Assignment No \t\t Date \t\t Status");
        while (record = mysql_fetch_row(rs)){
            printf("%s\t\t %s\t\t",record[0], record[1] );
        strcpy(attemptstatus,"SELECT UserCode FROM scores WHERE AssignmentID= \'");
        strcat(attemptstatus, record[0]);
        strcat(attemptstatus, "\'AND UserCode=\'");
        strcat(attemptstatus, usercode);
        strcat(attemptstatus, "\'");
        mysql_query(conn, attemptstatus);
        rs1 = mysql_store_result(conn);
        record1=mysql_fetch_row(rs1);
        if(record1>0)
            printf("Attempted\n");
        else
            printf("Not attempted\n");
        }
        mysql_close(conn);
 }
 //this function is for viewing details of a particular assignment from the database
 void viewAssignment(){
     char sqlquery[255];
     char checkactive[255];
     MYSQL_RES *check;
    int assignmentID;
         conn = mysql_init(0);
         MYSQL_ROW record1;
         MYSQL_ROW recordcheck;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }


         char str[2];
         printf("Enter assignmentID:\t");
         scanf("%s", str);
         fflush(stdin);



         strcpy(myquery, "SELECT * FROM assignment WHERE AssignmentId = \'");
         strcat(myquery, str);
         strcat(myquery, "\'");

         if(mysql_query(conn, myquery)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs1 = mysql_store_result(conn);
        if(rs1==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        puts("ID\t\tCharacters\t\tDate\t\tStartTime\t\tEndTime");
        record1 = mysql_fetch_row(rs1);
            printf("%s\t\t %d\t\t %s\t\t %s\t\t %s\t\t\n",record1[0], strlen(record1[1]), record1[2], record1[3], record1[4] );
        mysql_close(conn);
 }


 //this function is for attempting an assignment
 void attemptAssignment(){
     char sqlquery[255];
     char checkactive[255];
     MYSQL_RES *check;
    int assignmentID;
         conn = mysql_init(0);
         MYSQL_ROW record1;
         MYSQL_ROW recordcheck;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }

        strcpy(checkactive,"SELECT status1 FROM pupils WHERE UserCode= \'");
        strcat(checkactive, usercode);
        strcat(checkactive, "\'");
        if(mysql_query(conn, checkactive)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         check = mysql_store_result(conn);
        if(check==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        recordcheck = mysql_fetch_row(check);

        if(strcmp(recordcheck[0],"Activated")!=0){
            puts("You have been deactivcated, please you can request for activation");
            main();
        }
         char str[2];
         printf("Enter assignmentID:\t");
         scanf("%s", str);
         fflush(stdin);



         strcpy(myquery, "SELECT * FROM assignment WHERE AssignmentId = \'");
         strcat(myquery, str);
         strcat(myquery, "\'");

         if(mysql_query(conn, myquery)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs1 = mysql_store_result(conn);
        if(rs1==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }

        record1 = mysql_fetch_row(rs1);

    char MM[3],HH[3],MM1[3],HH1[3];
        if(strcmp(datenow,record1[2])==0){
            char temp[10],temp1[10];
            strcpy(temp,record1[3]);
          HH[0]=temp[0];
           HH[1]=temp[1];
           MM[0]=temp[3];
           MM[1]=temp[4];

            strcpy(temp1,record1[4]);
          HH1[0]=temp1[0];
           HH1[1]=temp1[1];
           MM1[0]=temp1[3];
           MM1[1]=temp1[4];
           int a=atoi(HH) , b=atoi(HH1), c=atoi(MM), d=atoi(MM1);
           if(hournow>=a && b>=hournow){
            if((a!=b) || (minutesnow >=c && d>=minutesnow)){
                    printf("Ready for attempt\t\t \n");

                    attemptassignment(record1[1], record1[0]);
            }
            else
                printf("You cannot attempt this assignment now\n");

           }
            else
            printf("You cannot attempt this assignment now\n");

        }
        else
            printf("You cannot attempt this assignment now\n");
        mysql_close(conn);
 }

 //this function inserts a request into the database
 void requestActivation(){

   char checkactive1[255];
     MYSQL_RES *check1;

     conn = mysql_init(NULL);
         MYSQL_ROW record1;
         MYSQL_ROW recordcheck1;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }

         strcpy(checkactive1,"SELECT status1 FROM pupils WHERE UserCode= \'");
        strcat(checkactive1, usercode);
        strcat(checkactive1, "\'");
        if(mysql_query(conn, checkactive1)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         check1 = mysql_store_result(conn);
        if(check1==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        recordcheck1 = mysql_fetch_row(check1);

        if(strcmp(recordcheck1[0],"Activated")==0){
            puts("You are already activated");
            main();
        }

         strcpy(request,"INSERT INTO activationrequest values('yeyeye', \'");
         strcat(request,usercode);
         strcat(request,"\')");
         if(mysql_query(conn,request)){
            printf("Unable to insert data");
            mysql_close(conn);
         }
         mysql_close(conn);
         printf("Request sent");
 }

 //this function is for checking assignments between dates
 void checkDates(){
     char sqlquery[255];
    int assignmentID;
         conn = mysql_init(0);
         MYSQL_ROW record2;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }

         char str1[10];
         char str2[10];
         printf("From:\t");
         scanf("%s", str1);
         printf("To:\t");
         scanf("%s", str2);
         fflush(stdin);



         strcpy(dates, "SELECT AssignmentID FROM assignment WHERE Date BETWEEN \'");
         strcat(dates, str1);
         strcat(dates, "\'AND\'");
         strcat(dates, str2);
         strcat(dates, "\'");

         if(mysql_query(conn, dates)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs2 = mysql_store_result(conn);
        if(rs2==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        while (record2 = mysql_fetch_row(rs2)){
            printf("%s\n",record2[0]);
        }

        mysql_close(conn);
 }

 //this function is for viewing the status report
 void checkStatus()
{

    char report1[90];
    char report2[90];
    int num;
    int num1;
    float num3;
    float num4;
    conn = mysql_init(NULL);
    conn = mysql_real_connect(conn, "localhost", "root", "", "kindercare", 3306, NULL, 0);

    strcpy(report2, "SELECT count(AssignmentID) FROM assignment");
    mysql_query(conn, report2);
    res1 = mysql_store_result(conn);
    while ((row = mysql_fetch_row(res1)))
    {
        num=atoi(row[0]);
    }

    strcpy(report1, "SELECT UserCode,count(AssignmentID),avg(score) FROM scores WHERE UserCode= \'");
    strcat(report1, usercode);
    strcat(report1, "\'");
    if (mysql_query(conn, report1))
    {
       printf("Unable to connect");
            mysql_close(conn);
            return 1;
    }
    res = mysql_store_result(conn);

    printf("Usercode \t\tNumberOfAssignment \tAverage Mark \tPercentageAttempted\tPercentageMissed");
    printf("\n\n");
    while ((row = mysql_fetch_row(res)))
    {
        num1=atoi(row[1]);
        num3=(((float)num1/num)*100);
        num4=100-num3;
        printf("    %s\t\t\t %s\t\t %.5s%%\t\t   %.2f%%\t\t   %.2f%%\t\t\t\t", row[0],row[1],row[2],num3,num4);
        puts("");
    }

}

 //this function is for viewing scores and comments for a particular pupil
 void viewScores(){
     char sqlquery[255];
     char checkactive[255];
     MYSQL_RES *check;
    int assignmentID;
         conn = mysql_init(0);
         MYSQL_ROW record1;
         MYSQL_ROW recordcheck;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }



         strcpy(myquery, "SELECT * FROM scores WHERE UserCode = \'");
         strcat(myquery, usercode);
         strcat(myquery, "\'");

         if(mysql_query(conn, myquery)){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs1 = mysql_store_result(conn);
        if(rs1==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }
        puts("ID\t\tScore\t\tComment");
        while(record1 = mysql_fetch_row(rs1)){
            printf("%s\t\t %s\t\t %s\t\t\n",record1[1], record1[2], record1[3]);
        }
        mysql_close(conn);
 }

 //function grade marks a character from the assignment cell by cell
int grade(int A[26][28], int B[], int c){
    int cellscore = 0;
    for(int index=0; index<28; index++){
        if(A[c][index]==B[index])
            cellscore += 1;
    }
        return cellscore;

}
//function reference determines the index of the letter that is being attempted by a pupil
int reference(char c){

    char letters[]="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for(int i=0; i<26; i++){
        if(c==letters[i])
            return i;

    }
}
void attemptassignment(char assignment[8], char id[2]){
//m is a multidimensional array containing patterns of all letters A-Z
    int m[26][28]={{0,1,1,0,1,0,0,1,1,0,0,1,1,1,1,1,1,0,0,1,1,0,0,1,1,0,0,1},
    {1,1,1,0,1,0,0,1,1,0,0,1,1,1,1,0,1,0,0,1,1,0,0,1,1,1,1,0},
    {0,0,1,1,0,1,0,0,1,0,0,0,1,0,0,0,1,0,0,0,0,1,0,0,0,0,1,1},
    {1,1,0,0,1,0,1,0,1,0,0,1,1,0,0,1,1,0,0,1,1,0,1,0,1,1,0,0},
    {1,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1},
    {1,1,1,1,1,0,0,0,1,0,0,0,1,1,1,1,1,0,0,0,1,0,0,0,1,0,0,0},
    {0,1,1,0,1,0,0,1,1,0,0,0,1,0,0,0,1,0,1,1,1,0,0,1,0,1,1,0},
    {1,0,0,1,1,0,0,1,1,0,0,1,1,1,1,1,1,0,0,1,1,0,0,1,1,0,0,1},
    {1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0},
    {0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,1,0,0,1,1,0,0,1,0,1,1,0},
    {1,0,0,1,1,0,1,0,1,1,0,0,1,0,0,0,1,1,0,0,1,0,1,0,1,0,0,1},
    {1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,1,1,1},
    {1,0,0,1,1,1,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1},
    {1,0,0,1,1,1,0,1,1,0,1,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1},
    {0,1,1,0,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,0,1,1,0},
    {1,1,1,0,1,0,0,1,1,0,0,1,1,1,1,0,1,0,0,0,1,0,0,0,1,0,0,0},
    {0,1,1,0,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,0,1,1,0,0,0,0,1},
    {1,1,1,0,1,0,0,1,1,0,0,1,1,1,1,0,1,1,0,0,1,0,1,0,1,0,0,1},
    {0,1,1,0,1,0,0,1,1,0,0,0,0,1,1,0,0,0,0,1,1,0,0,1,0,1,1,0},
    {1,1,1,1,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0},
    {1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,0,1,1,0},
    {1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,0,1,0,0},
    {1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,0,0,1,1,1,0,1,1,0,0,1},
    {1,0,0,1,1,0,0,1,1,0,0,1,0,1,1,0,1,0,0,1,1,0,0,1,1,0,0,1},
    {1,0,0,1,1,0,0,1,1,0,0,1,0,1,0,0,0,1,0,0,0,1,0,0,0,1,0,0},
    {1,1,1,1,0,0,0,1,0,0,1,0,0,1,0,0,1,0,0,0,1,0,0,0,1,1,1,1}
    };

    MYSQL_ROW done;
    char assign[255];
     strcpy(assign,"SELECT UserCode FROM scores WHERE AssignmentID= \'");
        strcat(assign, id);
        strcat(assign, "\'AND UserCode=\'");
        strcat(assign, usercode);
        strcat(assign, "\'");
        mysql_query(conn, assign);
        rs1 = mysql_store_result(conn);
        done=mysql_fetch_row(rs1);
        if(done>0)
            printf(" Assignment is already attempted\n");
        else{
            printf(" Assignment Not yet attempted\n");
    time_t start,stop;
    float tot=0;
    char e;
    int score=0;

    int Answer[28];


    for(int d=0;d<strlen(assignment);d++){
       printf("\nDraw pattern for %c (Enter 1 or 0 for each cell)\n\n",assignment[d]);
            int k=0;
            start= time(NULL);
            kcel:


            for(int row=1; row<=7; row++){
                for(int col=1; col<=4; col++){

                    printf("[%d][%d] -> ",row,col);
                    e=getch();
                    if(e=='1'){
                            Answer[k]=1;
                            printf("*");

                    }
                    else if(e=='0'){
                            Answer[k]=0;
                            printf(" ");
                    }
                    else{
                        printf("wrong input,repeat character\n");
                        goto kcel;
                    }
                    printf("\t");
                    k++;
                }
                printf("\n");
        }

        int charIndex= reference(assignment[d]);

        score += grade(m,Answer,charIndex);
        stop=time(NULL);
        tot += difftime(stop,start);


    }
    printf("Time taken is %f seconds\n",tot);
    float finalscore;
    float den=strlen(assignment)*28.0;
    finalscore = (score/den)*100.0;
    printf("score is %.0f percent\n\n",finalscore);

    int finalscore2=finalscore;
    char finalscore3[4];
    sprintf(finalscore3, "%d", finalscore2);
    char insertscores[255];
    conn = mysql_init(NULL);
         MYSQL_ROW record1;
         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }

         strcpy(insertscores,"INSERT INTO scores(UserCode,AssignmentID,score) values(\'");
         strcat(insertscores,usercode);
         strcat(insertscores,"\',\'");
         strcat(insertscores,id);
         strcat(insertscores,"\',\'");
         strcat(insertscores,finalscore3);
         strcat(insertscores,"\')");

         if(mysql_query(conn,insertscores)){
            printf("Unable to insert data");
            mysql_close(conn);
         }
         mysql_close(conn);
        puts("Correct patterns for attempted letters\n");
         for(int i=0; i<strlen(assignment);i++){
            int n=0;
            for(int j=0; j<7; j++){
                for(int k=0; k<4;k++){
                    int charIndex1= reference(assignment[i]);
                    if(m[charIndex1][n]==1)
                        printf("*");
                    else
                        printf(" ");
                        n++;
                }
                printf("\n");
            }
         printf("\n\n");
         }
         }
}

void timeAndDate(){
    time_t t;

    t = time(NULL);
    struct tm tm = *localtime(&t);


    char day[3];
    int third = tm.tm_mday;
    sprintf(day, "%d", third);


    char month[3];
    int second=tm.tm_mon+1;
    sprintf(month, "%d", second);


    char year[5];
    int first=tm.tm_year+1900;
    sprintf(year, "%d", first);

    strcpy(datenow,year);


    strcat(datenow,"-");

    if(strlen(month)==1){
        strcat(datenow,"0");
        strcat(datenow,month);
    }
       else
            strcat(datenow,month);
    strcat(datenow,"-");
    if(strlen(day)==1){
        strcat(datenow,"0");
        strcat(datenow,day);
    }
       else
            strcat(datenow,day);
    hournow = tm.tm_hour;
    minutesnow = tm.tm_min;
}


void main() {

        timeAndDate();


   char command[30];

    conn = mysql_init(0);
         MYSQL_ROW record0;


         if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
         fprintf(stderr, "%s\n", mysql_error(conn));
         exit(1);
         }
        failedPassword:
        printf("Enter usercode to login:\t");
        scanf("%s",usercode);
         if(mysql_query(conn, "SELECT UserCode FROM pupils")){
            printf("Unable to connect");
            mysql_close(conn);
            return 1;
         }
         rs = mysql_store_result(conn);
        if(rs==NULL){
            printf("Unable to compile SQL statement\n");
            mysql_close(conn);
            return 1;
        }

        while (record0 = mysql_fetch_row(rs)){

                if(strcmp(usercode,record0[0])==0){
                    printf("User %s\t, You have logged in.",record0[0]);

                    mysql_close(conn);
                    goto succesfulLogin;

                }
        }
        puts("Usercode does not exist\n");
        goto failedPassword;

    succesfulLogin:
    puts("\t\t....................Commands.....................");
    puts("\t\tViewall:  Displays assignment number, date and attempt status");
    puts("\t\tCheckstatus:  Displays pupil status report");
    puts("\t\tViewassignment (assignmentID):  Displays details of a specified assignment");
    puts("\t\tCheckdates (date from date to): Displays assignments with in a specified date range");
    puts("\t\tRequestActivation:  To request your teacher for activation");
    puts("\t\tAttemptAssignment:  To attempt an assignment");
     puts("\t\tViewScores:  To view scores and comments of attempted assignments");

    start:
    puts("\nEnter command");
    scanf("%s",command);

    if(strcasecmp("Viewall",command)==0){
        viewAll();
        goto start;
        }
    else if(strcasecmp("Viewassignment",command)==0){
        viewAssignment();
        goto start;
        }
    else if(strcasecmp("Checkdates",command)==0){
        checkDates();
        goto start;
        }
    else if(strcasecmp("RequestActivation",command)==0){
        requestActivation();
        goto start;
        }
        else if(strcasecmp("Checkstatus",command)==0){
        checkStatus();
        goto start;
        }
         else if(strcasecmp("AttemptAssignment",command)==0){
        attemptAssignment();
        goto start;
        }
         else if(strcasecmp("ViewScores",command)==0){
        viewScores();
        goto start;
        }
    else
    {
        puts("Wrong input");
        goto start;
    }

return 0;


}

