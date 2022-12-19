Open Source Social Network - Installation on Microsoft IIS 7+
==============================================================

The following instructions are targeted at developers and shows how to configure Open Source Social Network to run using Microsoft's Internet Information Server, aka IIS, on Windows.

1. Install Microsoft's version of Apache mod rewrite, URL Rewrite, from the official source [here](https://www.iis.net/downloads/microsoft/url-rewrite).
2. Install the Windows version of a [recent PHP release](https://windows.php.net/download#php-8.1) onto the web server machine.  For reference, I am using the 64 bit version of Windows Server 2019, and chose the PHP 8.1.13 VS16 x64 Non-Thread-Safe download.  You'll need to download Microsoft's C++ Redistributable from [here](https://learn.microsoft.com/en-us/cpp/windows/latest-supported-vc-redist?view=msvc-170) prior to installing PHP.
2. Create two folders in your web server's filesystem.
    a. A folder for the php files, in the Inetpub folder.  By default, the following works:  `C:\inetpub\ossn`
    b. A folder for the site data, *outside of the inetpub folder*; perhaps `C:\ossn-data`.
3. Install a git client, (I chose the [classic git command-line interface](https://git-scm.com/docs/gitcli)), then clone the Open Source Social Network code into your given folder.  For example, assuming `C:\inetpub\ossn` is your target folder, do the following:
    ```
    cd \inetpub
    mkdir ossn
    cd ossn
    git clone https://github.com/opensource-socialnetwork/opensource-socialnetwork.git
    ```
4. Add a "site" in IIS Manager for Open Source Social Network; I chose to call it `OSSN` for simplicity.  Adding a site by default creates a new "application pool", which includes support for ASP.Net.  You can disable ASP.Net in the OSSN application pool, since it is not required.
5. Select the OSSN site in IIS Manager, then click the `URL Rewrite` applet in the pane on the right.  
6. Click on the "Import Rules" action in the "Actions" pane on the far right, then copy-and-paste in the following rules [taken from the htaccess.dist file](https://github.com/opensource-socialnetwork/opensource-socialnetwork/blob/v6.x/installation/configs/htaccess.dist):

```
RewriteRule ^rewrite.php$ installation/tests/apache_rewrite.php [L]

RewriteRule ^action\/([A-Za-z0-9\_\-\/]+)$ system/handlers/actions.php?action=$1&%{QUERY_STRING} [L]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([A-Za-z0-9\_\-]+)$ index.php?h=$1 [QSA,L]

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([A-Za-z0-9\_\-]+)\/(.*)$ index.php?h=$1&p=$2 [QSA,L]
```

Click the "Apply" link after pasting in the rules, and you should see 4 rules displayed in the list of URL Rewrite rules.

7. From the main IIS Site window, click the "PHP Manager" link, then click the "Enable or Disable an Extension" and ensure the following PHP extensions are enabled:
   a. php_curl.dll
   b. php_exif.dll
   c. php_fileinfo.dll
   d. php_gd.dll
   e. php_gd2.dll
   f. php_gettext.dll
   g. php_imagick.dll (you'll need to download [Imagick for PHP](https://phpimagick.com/) for this extension to work; the extension itself is [here](https://pecl.php.net/package/imagick/3.7.0/windows).  Ensure you chose the same architecture and thread-safety as your chosen PHP install.)
   h. php_intl.dll
   i. php_mbstring.dll
   j. php_mysql.dll
   k. php_mysqli.dll
   l. php_openssl.dll
   m. php_pdo_mysql.dll
   n. php_soap.dll
   o. php_xmlrpc.dll

   (all three MySQL extensions, mysql, mysqli, and pdo_mysql, need to be enabled).

8. Install the latest version of MySQL for Windows from the [official site](https://dev.mysql.com/downloads/).  Create a schema and user in MySQL for your OSSN installation, and record the username and password in a reputable local password manager such as KeePass, for future reference.

9. Configure the desired bindings for your website, and point your browser at it.  You should see the installation screen, as shown in [How to install Open Source Social Network](https://www.opensource-socialnetwork.org/wiki/view/706/how-to-install-open-source-social-network).