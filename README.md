# FermentationStation

PHP, phpMyAdmin, MySQL, HTML, CSS and JavaScript.

This is a site in which users can view recipes for fermentations, insert their own recipes into the website, view other users' profiles and recipes 
and comment on other users' content. 

The site features a log in/log out system, admin only features (such as upgrading a user to an admin and upgrading/deleting content), commenting system, 
the ability to update and delete your own recipes. 

I created this project in an effort to mainly focus on learning object orientated PHP and followed the CMV model in order to organise the files. I wanted to mainly
focus on handling and submitting forms, understanding $_SESSION variables and using $_GET and $_SESSION variables to add different types of functionality to the site
depending on what kind of user was currently logged in. I also wanted to understand how I could combine PHP, PHPMyAdmin and MySQL in order to organise a database so the content 
on the site could be dynamically generated, edited and updated. I also wanted to get a feel for handling errors and displaying/working around potential errors, but 
as this was a personal project security was not a top priority and as such the site has some major flaws. I had implemented an authorization feature, but was unable to get
this working at a later point in development.

While the main focus was on PHP I also wanted to work on a larger scale project than what I have previously worked on and try to manage the CSS and HTML on a project
like this. I included some animations on the site to make it a bit more visually appealing, and I tried to minimize the amount of CSS in order to be as efficient as possible.
I feel that the interface is very simple and had I had time I would have liked to implement a toggleable nav menu in order to clean up the top nav bar.

Thirdly, I wanted to include some JavaScript elements that I had never worked with before, but have obviously seen elsewhere on the web. I followed a tutorial in order
to implement the image carousel on the index page, but would have liked to expand this out to feature mini carousels on individual pages. I also implemented modals on the page
for form submission in order to present a simpler and cleaner interface rather than have separate pages for this like in earlier iterations of the project. I also used a tiny bit 
of asyncronous JavaScript in order to add functionality to buttons/inputs that are dynamically generated.

======== KNOWN BUGS/ISSUES =========

- When a user logs in there is an error notice about a session having already being started on the index page. This is resolved once the user navigates away and returns.
- Security issue with users being simply able to visit localhost:..../users.php in order to access admin features.
- Some users are able to access admin pages when they should not be able to. I actually suspect this is to do with very old users in the database which do not follow the same
  conventions as users added past a certain point in development.
