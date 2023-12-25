<Mohammed Efaz>
<ZTFK53>
Web programming - assignment
This solution was submitted and created by the student above for the Web Programming course.
I declare that this solution is my own work. I did not copy or use it from a third party
solutions from third parties. I did not forward my solution to my fellow students, nor did I publish it.
Eötvös Loránd University Student Requirements System
(Organizational and Operational Regulations of ELTE, Volume II, § 74/C) states that as long as,
as long as a student has been working on the work - or at least a significant part of it - of another student
of another student's work as his or her own, it is a disciplinary offence.
The most serious consequence of a disciplinary offence is dismissal from the university.

### Minimum required (not accepted without them, 6 points)
[ ] `0.0 points` Readme.md file: completed, uploaded
[ ] `0.0 points` Main page: displayed
[ ] `1.0 points` Main page: listing of all cards, e.g. with pictures
[ ] `1.0 points` Main page: click on the name of the card to go to the details page of the corresponding card
[ ] `1.0 point` Card details: Display the name, HP, description and element of the monster on the card
[ ] `0.5 points` Card details: The image associated with the card is displayed
[ ] `0.5 points` Card details: the colour or background colour of one or more elements on the page changes according to the element of the monster on the card, e.g. Fire is red, Lightning is yellow, etc.
[ ] `2.0 points` Admin: Create new card: error handling, successful save (without authentication)

### The basic tasks (14 points)
[ ] `0.5 points` Registration form: contains appropriate elements
[ ] `0.5 points` Registration form: error handling, error message, status maintenance
[ ] `0.5 points` Registration form: Successful registration
[ ] `0.5 points` Login: Error handling
[ ] `0.5 points` Login: Successful login
[ ] `0.5 points` Logout
[ ] `0.5 points` Main page: User name and money displayed
[ ] `0.5 points` Main page: Click on the username to go to the user details page
[ ] `1.0 point` Main page: Allows you to filter cards by type.
[ ] `0.5 points` User details: Displays the user's name, email address, money
[ ] `0.5 points` User details: Cards associated with the user are displayed
[ ] `2.0 points` User details: a sell button appears next to the user's cards, which allows the user to sell the card, the sold card is deleted from the user's cards and the user receives 90% of the price of the card. The sold card is returned to the ADMIN deck. (Where and how you place the sell button is up to you)
[ ] `0.5 points` Admin: You can log in with the admin user details
[ ] `0.5 points` Admin: New card creation is only available with Admin user
[ ] `0.5 points` Main page: When logged in, a buy button should appear under each card
[ ] `1.5 points` Main page (Buy): You can buy the card
[ ] `0.5 points` Main page (Buy): You can only buy as much as you have
[ ] `0.5 points` Main page (Buy): You can buy up to 5 cards
[ ] `1.0 point` Nice design

### Extra tasks (at most plus 5 points)
[ ] `0.5 points` Admin: Card modification: available to admin user for cards not yet sold
[ ] `0.5 points` Admin: Card modification: error handling, status maintenance, successful save
[ ] `1.0 point` Main page: click on a button on the main page to allow non-admin users to buy a random card with their money, a random card can cost e.g.: 50 coins.
[ ] `2.0 points` Main page: on the main page only 9 cards should be displayed at a time, underneath them you can navigate through the pages (with page numbers, arrows). Always display cards corresponding to the current page number, each page should display the next 9 cards. To solve this, use AJAX/fetch.
[ ] `1.0 point` Exchange Step 1: On the main page, for cards that are not in the admin and are in our house, a replacement button should appear, which the user can click to replace any card with this card.
[ ] `1.0 point` Exchange Step 2: The exchange should not be immediate and voluntary, but the other party should be notified and be able to accept or reject it.
[ ] `1.0 point` Exchange Step 3: The exchange can include the possibility to add money to either side. Watch out for negative numbers!
