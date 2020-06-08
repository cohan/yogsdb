# YogsDB

YogsDB is a project that indexes [The Yogscast](https://yogscast.com)'s videos.

There is no support for hosting it yourself at this time. I actually wouldn't advise it anyway. You're on your own.

## The Rebuild

The master (at time of writing) is the current production code. It's horrible. This was the first project I started when I started using Laravel.

Don't use it for anything, don't issue PRs to it. Security fixes only.

The new version is in the [develop](/cohan/yogsdb/tree/develop) branch. Develop will auto-deploy to a staging site and eventually will be merged into master once it's working.

All work on the current site is on hold.

## Yo there's no issues

Aye I was using GitLab to host this when it was private but I've moved it to GitHub to ~~boost my contribution stats~~ because everyone's probably used to GitHub for open source projects.

I'll move my backlog over once the new site's ready if the issues still apply.

## YouTube's request

Regarding the API access YouTube have actually been pretty reasonable. There's only a couple of things they want changing.

1) Please reference YouTube TOS/Privacy docs ([#6](https://github.com/cohan/yogsdb/issues/6))
2) Refresh or delete content before 30 days ([#7](https://github.com/cohan/yogsdb/issues/7))

The latter will be the biggest pain in the rear because I've decided it's time to blow out the crappy code cobwebs and re-do the project over.
