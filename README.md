# YogsDB

YogsDB is a project that indexes [The Yogscast](https://yogscast.com)'s videos.

There is no support for hosting it yourself at this time. I actually wouldn't advise it anyway. You're on your own.

## The Rebuild

The master (at time of writing) is the current production code. It's horrible. This was the first project I started when I started using Laravel.

Don't use it for anythig, don't issue PRs to it. Security fixes only.

The new version is in the [deploy](cohan/yogsdb/tree/feature/minimal) branch. Deploy will auto-deploy to a staging site and eventually will be merged into master once it's working.

All work on the current site is on hold.

## YouTube's request

Regarding the API access YouTube have actually been pretty reasonable. There's only a couple of things they want changing.

1) Please reference YouTube TOS/Privacy docs ([#6](https://github.com/cohan/yogsdb/issues/6))
2) Refresh or delete content before 30 days ([#7](https://github.com/cohan/yogsdb/issues/7))

The latter will be the biggest pain in the rear because I've decided it's time to blow out the crappy code cobwebs and re-do the project over.