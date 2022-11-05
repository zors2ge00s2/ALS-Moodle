# Moodle ALS:  

#### Note: internally, Moodle uses the term Assignment for the structure that we use to represent our exercises. An assignment is a page with submission and grading options available, but the grading part has been hidden and when creating or editing an assignment there's always the option to leave no submission options.  

## Appearance/Theming:  

The current theme is called Adaptable, named such for the ease with which you can customize a lot of the aspects of the theme. Part of it is a custom CSS section, which can be found in the navigation bar at Site Administration > Appearance > Themes > Adaptable > Custom CSS & JS.  

Many of the custom CSS rules include inheriting the background (done with `background: inherit` ) of their parent element, this is so that we should be able to set the background in the CSS for the `<body>` tag and not have to worry about clipping between the boundaries of the various blocks on the page.  

## Exercise Linking:  

The exercises are linked to each other in the Moodle files, such that a user can go through their day's exercises in succession (including the videos and lectures they should see for the day) and finish with a thank you message.  
This is done with a file in /lib/dest/assign_destinations.txt which contains the mappings, and updated when /lib/upload_destinations.php is run. It's best practice to delete all the former mappings before updating them, there's a function in /lib/upload_destinations that does just that when it is run.  
The syntax for mappings is as follows:  
`origin, destination, groupa, groupb, groupc, groupd, groupe, is_assign, day, role_id`  

The groups can be left blank or take a yes or no, is_assign is a boolean, origin and destination are the module id for an exercises's page (you can find this at the end of the url, for instance for https://mindful.rc.fas.harvard.edu/mod/assign/view.php?id=141 the module id would be 141). `groupa` represents whether the assignment has the filter Bulbar Involvement: Yes or Bulbar Involvement: No, `groupb` represents Upper Limb Impairment: Yes/No, `groupc` represents Wheelchair: Yes/No, `groupd` represents Cane/Walker: Yes/no, and `groupe` represents Non-invasive Ventilation: Yes/no.  
`role_id` is either 9 for patient or 10 for caregiver. `day` is the day the assignment is on, represented as an integer indexed to 1 (so the first day is 1 and week 3 day 7 is 21).  

Here are a handful of examples that should prove illustrative.
These are all the mappings for week 1 day 1 for patients.  
`182, 183, ,  , , ,  ,TRUE, 1, 9`  

`183, 141, ,  , , ,  ,TRUE, 1, 9`  

`141, 184, ,  , , ,  ,TRUE, 1, 9`  

`184, 185, ,  , , ,  ,TRUE, 1, 9`  
So far the pathing has been linear, but it branches here because there's two different exercise 2's, depending on whether the patient has expressed a preference towards exercises adjusted for Upper Limb Impairments.  

`185, 35, , no, , , ,TRUE, 1, 9`  

`185, 36, , yes, , , , TRUE, 1, 9`  
Now there is only one 3rd exercise so the divergent paths have to converge again.  
`35, 37,  ,  no,  ,  ,  ,TRUE, 1, 9`  

`36, 37,  ,  yes,  ,  ,  ,TRUE, 1, 9`  

`37, 13,  ,  ,  ,  ,  ,TRUE, 1, 9`  
After the final exercise of the day, the user is automatically taken to the thank you message for the day. If there's a day with a single exercise, set the destination to -1 and it should take users to the thank you page. You still need the linking in so that the front page will link to the exercise, and the exercise will link to the thanks for doing today's exercises page.  

The place where the click for next/previous assignment buttons gets added is in `/mod/assign/renderer.php`.
The calculations for relativedate (which is how we restrict access to users who have reached a certain number of days since starting the course, or variations thereof) occur in `/availability/condition/relativedate/classes/condition.php`.
To change the mappings server side, go to `/lib/dest/assign_destinations.txt`. Once you're done assigning things, run `/lib/upload_destinations.php`. Or, go to the website url and append `/lib/update_destinations.php` and that will allow you to do it from the browser.
The cron task that runs to determine whether users have progressed to the next day in the course is defined in `/mod/assign/classes/task/course_check_progression.php`, and is described further below.

## User's Day in course Progression:  
A user's progression through the course is handled not with a calendar but with a value stored on the user's database relation, in the icq column (an unused column I've backronymed Internal Calendrical Quotient). This is tied into the relative date system for assignments, which is found in /availability/condition/relativedate/classes/condition.php. I adjusted that plugin to handle our proprietary date enumeration system.  
The way progression works now is that if a user completes all of their available exercises for the day, they will be allowed to move on to the next day's exercises once the day ends. This is because there is a cron task that runs at 6 AM every morning that calculates this for every user. That task is located at `/mod/assign/classes/task/course_check_progression.php`. If the user has new assignments available, they should receive an email alerting them to that fact. 

## SSL:
acme.sh is the client used to fetch Let's Encrypt SSL/TLS certificates. socat is used to pipe the traffic to the correct port (the docker image didn't have port 443 open and was already running, in future installs just make sure to leave port 443 open for HTTPS traffic). 

## Database:  
The database is a standard docker mysql container, that is linked into the Moodle container. (Find notes on command used to `up` it initially).

## Installation:
##Find installation notes. Make sure that making a backup/uploading a backup is enough to maintain all the uploaded files etc.##

## Assignment (Exercise): 
Inside the Assignment files (/mod/assign), there have been some changes made to specifically what gets rendered, notably that the ability to keep editing the exercise can be cut off after a certain amount of time now (by hiding the submission button after that time). Also, the grade menu has been commented out (we're not using grades) and the completion status table has been simplified. On the course page, exercises that have been completed will not show up anymore (this is handled with a CSS trick, see the Appearance section, I believe the tag is `.submitted` ##check this##) but they still show up in the navigation bar.  
Other notable exercise/assignment related information is that ##what was it?## 

## Video logging:  
The javascript for video logging is inserted when you insert a video in the atto editor (the standard text editor for administrator accounts). This code is generated from JavaScript within the Atto editor, which is found at `/lib/editor/atto/plugins/media/yui/src/button/js/button.js`. Any changes to this code (or any of the other JavaScript) should be compiled and minified to get the site to run it properly, as described at [Moodle JavasSript](https://docs.moodle.org/dev/Javascript_Modules#How_do_I_write_a_Javascript_module_in_Moodle.3F).  
There is a moodle event that fires when the user pauses a video (which includes Seeking) that logs where the user started watching this sub segment of the video and what time they paused it at. The files that had to be edited for that are `/mod/assign/classes/events/view_video.php`, `/mod/assign/db/services.php`, `/mod/assign/classes/external.php`. The video viewed event in its other column has a JSON structure that contains the videoid of the video viewed, as well as the start and end times of this watched segment of the video.



## SMTP email client:
Currently using HUIT's email client that they provided the credentials for. If migrating off Harvard infrastructure will need a new SMTP email system, and to change it just search for SMTP in the search bar at the bottom of the navigation bar (or go to `https://mindful.rc.fas.harvard.edu/admin/settings.php?section=outgoingmailconfig`) and change the credentials there.



## Cron:
The Docker container does not automatically start cron (looking into if it's possible to run it as part of the Docker creation) so you may have to manually get it running. 
Run the command `$ crontab -u www-data -e` and then in that file put `* * * * * root /usr/bin/php /var/www/html/admin/cli/cron.php >/dev/null`. To configure when specific cron tasks are running, go to `https://mindful.rc.fas.harvard.edu/admin/tool/task/scheduledtasks.php`. It's fairly vital that cron is running correctly for the site to function properly.
