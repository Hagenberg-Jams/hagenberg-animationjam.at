# Hagenberg Animation Jam website

Static site for https://hagenberg-animationjam.at, built with the Jam Engine (`vendor/hagenberg-jams/jam-engine`, HydePHP) and deployed to Cloudflare Pages. See `README.md` for the content workflow.

## Commands

```bash
composer install && npm install
npm run build             # builds _media/app.css and _media/app.js, which are not in Git
php hyde serve            # dev server
php hyde build            # builds the site into _site/
php hyde jam:validate     # checks the data
php hyde jam:check-links  # checks internal links of the built site
php hyde jam:topic-release 2026-11-20 19:00  # sets the topic release of the newest jam
```

## Rules

- This repository only holds content and settings. Shared behaviour belongs in the engine: https://github.com/Hagenberg-Jams/jam-engine
- Never write a jam's topic into this public repository before its `topic_release`. It belongs in the `JAM_TOPIC` GitHub secret until then. The workflow uploads it to Cloudflare as `JAM_TOPIC_DATA` together with the year, see section 4 of `README.md`.
- Pushing to `main` deploys to production immediately. Use a pull request for a preview.
- Quote dates with a time in YAML, for example `'2026-11-21T09:00:00+01:00'`.
- Code, comments, site copy and docs are in English.

## Commits

Commit only under the maintainer's Git identity. Never set Claude as author and never add a `Co-Authored-By` trailer.
