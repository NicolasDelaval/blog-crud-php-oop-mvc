<?php
// Initialize redirect method which will be user in the following controllers : commentsController, postsController, usersController.
function redirect($url){
 	header('Location: '. $url);
}