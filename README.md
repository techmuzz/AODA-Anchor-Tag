# Custom Hyperlinks
A WordPress plugin to append extra content to anchor tag having external link.

# Dev Setup
- Create an empty folder for `wordpress`
- put `docker-compose.yml` in it
- run `docker-compose up -d`
- copy current folder as plugin in wordpress admin area once you enable volumn for container
- Start developing :-)

# Deploy new release
- Copy plugin related content to `trunk` folder
```
/admin
/includes
/language
/public
custom-hl.php
index.php
README.txt
uninstall.php
```
- Copy image resource from `resources` folder into `assets` folder
```
banner-*.png
icon-*.png
```
- SVN Commit with message
- Create new tag in `tags` folder, sometimes UI creates new tag but doesn't show proper success message, if UI is not able to create new tag then use this command to create new tag
```
svn cp trunk tags/NEW.TAG.VERSION
```
- Test the new deployment