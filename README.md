# Hagenberg Animation Jam website

Source of [hagenberg-animationjam.at](https://hagenberg-animationjam.at). The site is built with the [Jam Engine](https://github.com/Hagenberg-Jams/jam-engine). This repository only holds the content, settings and colours of the Animation Jam.

## Setup

You need PHP 8.2 or newer, Composer and Node.js. [Laravel Herd](https://herd.laravel.com) covers PHP and Composer.

```bash
composer install
npm install
npm run build     # builds the styles and scripts
php hyde serve    # opens the site on http://localhost:8080
```

## Changing the site

Every push to `main` goes live within a few minutes. To check a change first, open a pull request: the checks run, and a preview link appears in the pull request.

| What | Where |
| --- | --- |
| Home page text, images, sponsors | `_data/homepage.yaml` |
| Dates and topic release of a jam | `_data/jams/YYYY.yaml` |
| Animations of a year | `_data/projects/YYYY.yaml` |
| Imprint | `_data/imprint.yaml` |
| Latest jam, registration, awards, links | `config/jam.php` |
| Colours | `resources/assets/app.css` |
| Images | `_media/` |

To change the look of a part of the page, copy the matching view from `vendor/hagenberg-jams/jam-engine/resources/views/` to the same path in `resources/views/`. Your copy then wins. If it would help other jams too, please suggest it in the [engine repository](https://github.com/Hagenberg-Jams/jam-engine/issues).

## Before each jam

1. Create the year:

   ```bash
   php hyde jam:create-jam
   ```

   Answer the question about the topic release, and do not enter the topic.

2. Add the topic as a secret under **Settings → Secrets and variables → Actions** on GitHub:
   - `JAM_TOPIC`: the topic
   - `JAM_TOPIC_VIDEO` (optional): the YouTube ID of the reveal video
3. Start the **Site** workflow under **Actions**, or push a change, so that the secrets reach Cloudflare. Do this before the release time. **Without this step, the countdown reaches zero and no topic appears.**
4. Open registration in `config/jam.php` under `registration`.

The countdown and the reveal then run on their own. **Never write the topic into a file in this repository before its release, because the repository is public.** The build stops if you do.

## After each jam

1. Add the topic to `_data/jams/YYYY.yaml` as `topic:`.
2. Add the animations. Put a header image in `_input/header/` and any further images in `_input/screenshots/`, then run:

   ```bash
   php hyde jam:add-project --year=YYYY
   ```

   This needs [ImageMagick](https://imagemagick.org/script/download.php).
3. Enter the winners with the keys from `awards` in `config/jam.php`.

Use `php hyde jam:validate` to check your data, and `php hyde list jam` to see all commands.

## Updates

Dependabot opens a pull request when there is a new version of the engine. Check its preview, then merge it.
