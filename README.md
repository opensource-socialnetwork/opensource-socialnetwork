Open Source Social Network [10.2]
======================================
[![Open Source Love](https://badges.frapsoft.com/os/v2/open-source.svg?v=102)](https://www.opensource-socialnetwork.org/)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](https://www.opensource-socialnetwork.org/)
[![Download Latest](https://img.shields.io/badge/Download-Latest%20Version-blue.svg)](https://www.opensource-socialnetwork.org/download)

[![DeepScan grade](https://deepscan.io/api/teams/4774/projects/6525/branches/747601/badge/grade.svg)](https://deepscan.io/dashboard#view=project&tid=4774&pid=6525&bid=747601)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/88c6ef38f593440cafe7ba350e592649)](https://app.codacy.com/gh/opensource-socialnetwork/opensource-socialnetwork/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

## What Is Open Source Social Network (OSSN)?

**Open Source Social Network (OSSN) is free, open-source social networking software written in PHP that allows you to create your own social networking website, online community, or private social network.**

OSSN provides the essential tools to connect people, build communities, share content, and encourage interaction through member profiles, activity feeds, groups, photos, messaging, comments, and notifications.

It is a self-hosted social networking platform, giving you control over your website, source code, community, and data. You can customize its appearance, extend its functionality, and build a social network around your own interests, organization, or business.

OSSN is suitable for:

- Creating a social networking website.
- Building a private or public online community.
- Launching a membership-based social platform.
- Connecting employees or members of an organization.
- Creating interest-based and professional communities.
- Developing a social media platform with your own features.

OSSN is free and open-source social networking software. You can download, install, use, and customize it without paying a software license fee or monthly subscription.

With multiple language support, OSSN also makes it possible to build communities for audiences across different regions and cultures.

OSSN Licensed under the ***Open Source Social Network License (4.0) / Cryptographic Autonomy License version 1.0***

Kernighan & Ritchie (K&R Variant 1TBS) indentation standard is used for the OSSN. For coding standards you may see [following](https://github.com/opensource-socialnetwork/opensource-socialnetwork/wiki/Coding-Standards)

- Copyright (C) ENGR. SYED ARSALAN HUSSAIN SHAH <arsalan@buddyexpress.net>, <email@arsalanshah.com>,
- Copyright (C) OPEN SOURCE SOCIAL NETWORK <https://www.opensource-socialnetwork.org>,
- Copyright (C) OPEN TEKNIK LLC <https://www.openteknik.com>,
- Copyright (C) OPENHOST247 LLC <https://www.openhost247.com>,
- Copyright (C) 2015-2021 SOFTLAB24 LTD <https://www.softlab24.com>,
- Copyright (C) 2014-2015 INFORMATIKON TECHNOLOGIES <https://www.informatikon.com>

## Screenshots

OSSN comes with two bundled themes out of the box. Below are a few screenshots showcasing the interface including member profiles, groups, social features, and the mobile experience. To try it yourself, check out the live demo.

| | | |
|:-------------------------:|:-------------------------:|:-------------------------:|
|<img width="665" alt="open source social network landing page" src="https://www.opensource-socialnetwork.org/themes/default/images/s1.png?ossn_cache=03042026">| <img width="665" alt="open source social network facebook style landing page" src="https://www.opensource-socialnetwork.org/themes/default/images/landing-fui.webp?ossn_cache=0659e47d"> | <img width="665" alt="open source social network mobile view" src="https://www.opensource-socialnetwork.org/themes/default/images/mobilegbf.webp?ossn_cache=0659e47d">|
|<img width="665" alt="open source social network facebook style theme" src="https://www.opensource-socialnetwork.org/themes/default/images/fbgbe.webp?ossn_cache=0659e47d">| <img width="665" alt="open source social groups page" src="https://www.opensource-socialnetwork.org/themes/default/images/profilenewfg.webp?ossn_cache=0659e47d"> | <img width="665" alt="open source social network profile page facebook style" src="https://www.opensource-socialnetwork.org/themes/default/images/profilefb.webp?ossn_cache=0659e47d"> |

Visit https://www.opensource-socialnetwork.org/ for more details 


Languages
==========

|                     |                     |                    |
|---------------------|---------------------|--------------------|
| English             | French              | Spanish            |
| Italian             | Portuguese          | German             |
| Dutch               | Turkish             | Russian            |
| Hebrew              | Greek               | Esperanto          |
| Japanese            | Korean              | Indonesian         |
| Traditional Chinese | Sinhala             | Tamil              |
| Persian             | Hungarian           | Danish             |

Front-End Features
===================

| Feature | Feature |  Feature |  
|:-------------------------:|:-------------------------:|:-------------------------:|
| User Registration  | User Login | Profile |
| Profile Cover | Profile Photo | Profile Friends | 
| Friends Management | Live Chat | Messaging | 
| Wall Posts | Albums | Photos | Ads | 
| Groups | Friends Tagging | Block System | 
| Poke System | Comments | Likes and Reactions |
| Expense Mangement | Giphy Integeration in Comments |  Invite Friends | 
| Embed Videos | Smiles & Emojis | Site Pages (Terms, about, privacy) |
| Mobile Responsive |  Notifications | Search | 
| Gallery | Post Background | Realtime Comments | 
| Realtime Messages | Blogs | Themes on community |
| Mentions in comments | Custom Pages | Custom Menu Items |
| Captcha | Site Announcements | Greetings | 
| Login as | Progressive Web App | Microsoft Active Directory Login |
| Giphy Integeration | Many free components of community website |

Backend Features
=================

* Admin Dashboard for site overview
* Online users count, gender based graph
* Total site users count (by months) graph
* Component configurations 
* Add User
* Remove User
* Edit User
* Ads Manager
* Cache Settings
* Basic Settings
* Unvalidated users
* Custom pages
* Menu Builder
* Themes management
* Components Management
* WebServices API
* Manually validate unvalidated users
* and much more components settings

Prerequisite
=============

https://www.opensource-socialnetwork.org/wiki/view/706/how-to-install-open-source-social-network

Directory Permissions
============
OSSN must be installed into a directory writable by the webserver, or it will not function properly. For most Linux servers running Apache v2, making the parent directory writable is very simple:

```
chgrp www-data /path/to/ossn_parent_directory
chmod g+w /path/to/ossn_parent_directory
``` 

If you are not running Apache v2 or are using a different type of webserver, you'll need to read your system's documentation or speak to your server administrator before proceeding.

Installation
============
https://www.opensource-socialnetwork.org/wiki/view/706/how-to-install-open-source-social-network

- Web Installer https://www.opensource-socialnetwork.org/download
- Docker - https://github.com/opensource-socialnetwork/docker
- VM Image - https://www.opensource-socialnetwork.org/download-vm-image

Installation on Ubuntu 22.04/24.04/25.05/26.04 LTS
```
sudo add-apt-repository ppa:arsalanshah/opensource-socialnetwork
sudo apt-get update
sudo apt-get install opensource-socialnetwork
```
DEMO
====
http://demo.opensource-socialnetwork.org/

UPGRADE
========
https://www.opensource-socialnetwork.org/wiki/view/708/how-to-upgrade-ossn
