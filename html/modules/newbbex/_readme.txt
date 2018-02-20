Module		: newbbex
Author		: Hervé Thouzard (herve@herve-thouzard.com)
Website		: http://www.herve-thouzard.com
Date 		: 03/01/2004
Update 		: 01/03/20055 - 16/04/2005 - 27/07/2205 - 21/12/2005 - 15/01/2006
Type 		: Extension et modification du module forum
Xoops version used : 2.0.5.1 et 2.0.9.2
Crédits : This module is based on the original newbb 1 module so all the
		  credits go to their original authors.


Installation :
Install it as any other module


Note :
You can also use the default Xoops forum in its version 1 and 2
Newbbex uses different tables to store datas.


Differences with the original version :
First of all, the admin part has been rewied and now contains, like in phpbb,
a more visaul list of your forums with the possibility to add, delete
and modify categories and forums. You can also see the number of posts and
the total number of posts + replies. You have the possibility, for private
forums, to modify their permissions from this screen.

When you edit or when you create a new forum, you have 3 new options :

	Replace username with full name
This will replace the username with his full name
There's only in the notification's email that the username is keept

	View icons panel
Show or hide, when you create a new message or when you reply, the part
of the screen where you can select an icon for your message.

	View smilies panel
This acts like the previous option but for smilies.


You can also use 4 new blocks :
- Posts without answers
- Private subjects without answers
- Pubilc and private subjects without answer
- Forums Statistics


How to migrate from newbb to newbbex :
It's easy !
Some new fields were added to the tables compare to the original
version.
So you just have to create an sql export of your newbb forums and
once the sql file is created, just replace the tables names like this :

bb_categories 	=> bbex_categories
bb_forum_access	=> bbex_forum_access
bb_forum_mods 	=> bbex_forum_mods
bb_forums 	=> bbex_forums
bb_posts 	=> bbex_posts
bb_posts_text 	=> bbex_posts_text
bb_topics 	=> bbex_topics

