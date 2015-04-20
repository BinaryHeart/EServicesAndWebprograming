# What is this?
The lab instructions for the course *e-services and web programming*.

# What branches does the repo have?
We develop on *master* and publish on *gh-pages*. To understand how publishing to *gh-pages* work [read more here](https://help.github.com/articles/creating-project-pages-manually/) .

# Where is it published?
[uu-im.github.io/EServicesAndWebprogramming/](http://uu-im.github.io/EServicesAndWebprogramming/)

# But how do we actually publish?
If you're using bash (Mac or Linux) you can simply run the publish script placed in `bin/publish.sh`. If you're on Windows if would be fantastic if you could write up a little `.bat` file that runs the same commands. But anyways, these scripts are just convenience and ensure that we all publish in the same way. Essentially, publishing is simply done by merging the branch `master` into `gh-pages`. So essentially it goes something like this.

```bash
# Ensure your working directory is CLEAN
$ git status

# Jump over to the gh-pages branch
$ git checkout gh-pages

# Merge in the latest stuff from master into gh-pages
$ git merge --no-ff -m "Merging 'master' into 'gh-pages'" master 

# Jump back to master
$ git checkout master

# Push up all the changes and we're *drumroll* live!
$ git push --all
``` 

Oh bother writing all that, here's it all on one line.
```
git checkout gh-pages && git merge --no-ff -m "Merging 'master' into 'gh-pages'" master && git checkout master && git push
```
