# Hagenberg Animation Jam website

Source of [hagenberg-animationjam.at](https://hagenberg-animationjam.at). The site is built with the [Jam Engine](https://github.com/Hagenberg-Jams/jam-engine), which is shared with the other Hagenberg jams. This repository only holds the content, settings and colours of the Animation Jam.

This guide covers everything you need to run the site: the one-time setup, how a change goes live, and what to do when in a jam year.

## 1. Access

- **GitHub:** You need a GitHub account in the `animation-jam` team of the [Hagenberg-Jams](https://github.com/Hagenberg-Jams) organisation. That lets you push to this repository and start workflows.
- **Secrets:** Setting the topic secret needs admin access to this repository. Ask for it if the **Settings** tab is missing.
- **Hosting:** You do not need access to Cloudflare. GitHub Actions builds and deploys the site.

## 2. One-time setup

Install these tools:

| Tool | Why | Check with |
| --- | --- | --- |
| [Git](https://git-scm.com) | Download and upload changes | `git --version` |
| PHP 8.2 or newer and [Composer](https://getcomposer.org) | Build the site. [Laravel Herd](https://herd.laravel.com) installs both on Windows and macOS. | `php -v`, `composer -V` |
| [Node.js](https://nodejs.org) 24 LTS | Build styles and scripts | `node -v` |
| [ImageMagick](https://imagemagick.org/script/download.php) 7 | Image commands and responsive images. On Windows, tick "Add application directory to your system path" during installation. | `magick -version` |

Then get the site and start it:

```bash
git clone https://github.com/Hagenberg-Jams/hagenberg-animationjam.at.git
cd hagenberg-animationjam.at
composer install
npm install
npm run build     # builds the styles and scripts
php hyde serve    # opens the site on http://localhost:8080
```

Run `composer install`, `npm install` and `npm run build` again after pulling an engine update.

## 3. Making a change

Every push to `main` goes live within about three minutes. Work like this:

1. Get the latest version: `git pull`
2. Make your change. The table below shows where things are.
3. Check it on http://localhost:8080 while `php hyde serve` runs.
4. Check the data: `php hyde jam:validate`
5. Upload it:

   ```bash
   git add -A
   git commit -m "Describe your change"
   git push
   ```

6. Open the **Actions** tab on GitHub. A green tick on the latest **Site** run means the change is live. A red cross means the site was not updated. Open the run to see the error, fix it and push again. The live site stays as it was until then.

**To check a change before it goes live,** push it to a new branch and open a pull request. The checks run and a preview link appears as a comment in the pull request. Merge the pull request to publish it.

**Small text changes** also work on github.com: open the file, click the pencil, and commit to `main`. They go live the same way.

### Where things are

| What | Where |
| --- | --- |
| Home page: hero, highlights, about text, gallery, sponsors | `_data/homepage.yaml` |
| Dates and topic release of a jam | `_data/jams/YYYY.yaml` |
| Animations of a year | `_data/projects/YYYY.yaml` |
| Imprint | `_data/imprint.yaml` |
| Latest jam, registration, awards, links, contact email | `config/jam.php` |
| Colours | `resources/assets/app.css` |
| Images | `_media/` for the home page, `_media/YYYY/` for a year |

**Dates:** Put dates with a time in quotes and with the time zone, for example `'2026-11-21T09:00:00+01:00'`. Use `+01:00` in winter and `+02:00` in summer.

**Images:** Use WebP where you can. For each image on the home page, the build creates smaller copies ending in `-400w` and `-800w` next to it in `_media/`. Run `php hyde build` once after adding an image and commit these copies too. `php hyde jam:convert-images` converts JPG and PNG files to WebP and updates the YAML files.

**Sponsors:** Put the logo in `_input/sponsor/`, then run `php hyde jam:add-sponsor`. `php hyde jam:remove-sponsor` removes one.

**Changing the look:** Copy the matching view from `vendor/hagenberg-jams/jam-engine/resources/views/` to the same path in `resources/views/`. Your copy then wins. If it would help other jams too, please suggest it in the [engine repository](https://github.com/Hagenberg-Jams/jam-engine/issues).

## 4. A jam year, step by step

### Months before the jam

1. Create the year:

   ```bash
   php hyde jam:create-jam
   ```

   It asks for the year, the topic release, start, end and duration. Enter the release time, for example `2027-11-19 19:00`, and **do not enter the topic**. The command also makes the new year the latest jam.

2. Push. The home page now announces the dates and shows a countdown to the topic release.
3. Update `_data/homepage.yaml` if anything changed, for example the poster or the text.
4. Open registration in `config/jam.php`:

   ```php
   'registration' => [
       'active' => true,
       'url' => 'https://example.org/registration',
       'deadline' => '2027-11-12 23:59',
   ],
   ```

   The home page then shows a registration button and the deadline. The button stays until you set `'active' => false`, so do that when registration closes.

To move the topic release later, run `php hyde jam:topic-release 2027-11-19 19:00` and push. `--year=YYYY` picks another jam, `--remove` turns the countdown off.

### At least one week before the topic release

The topic must stay secret until the release time, but this repository and the built pages are public. So the topic never goes into a file. It is stored as a GitHub secret instead:

1. On GitHub, open **Settings → Secrets and variables → Actions** and click **New repository secret**.
2. Add `JAM_TOPIC` with the topic as plain text, for example `Lost in Time`.
3. Optional: add `JAM_TOPIC_VIDEO` with the YouTube ID of a reveal video. That is only the part after `v=`, for example `dQw4w9WgXcQ`. Set the video to unlisted on YouTube until the release.
4. Open **Actions → Site → Run workflow** and run it on `main`.
5. Open the run when it is finished. The step **Transfer the topic to Cloudflare** must show `Success! Uploaded secret JAM_TOPIC_DATA`.

**Without steps 4 and 5, the countdown reaches zero and no topic appears.** The topic is safe once it is uploaded: the server only hands it out from the release time on.

If the topic changes, update the secret and run the workflow again.

### Reveal day

Nothing to do. At the release time, the countdown turns into the topic on every open page, without reloading. The next build, at the latest the daily one at 04:00, also writes the topic into the page itself.

If the countdown reaches zero and no topic appears, the secret did not reach the server. Check the secret and run the workflow again. Open pages keep asking the server, so the topic appears on them about three minutes later without reloading.

### During the jam

If registration is still open, close it with `'active' => false` in `config/jam.php`. The announcement disappears from the home page when the jam starts, the topic block after the last day of the jam.

### After the jam

1. Add the topic to `_data/jams/YYYY.yaml`, and the video if there was one:

   ```yaml
   topic: 'Lost in Time'
   topic_video: 'dQw4w9WgXcQ'
   ```

2. Push, then delete the secrets `JAM_TOPIC` and `JAM_TOPIC_VIDEO` on GitHub. **Do it in this order,** because without the secret and without `topic:` in the file the topic disappears from the site. Nothing needs to be deleted on Cloudflare: the server ignores a topic from an earlier year.
3. Add the animations, one at a time. Put the header image in `_input/header/` and any further images in `_input/screenshots/`, then run:

   ```bash
   php hyde jam:add-project --year=YYYY
   ```

   It asks for the name, the YouTube links, the description, the team and the awards. The header image is cropped to 1920×520, further images are scaled to fit 1920×1080.
4. Enter the winners with the keys from `awards` in `config/jam.php`, for example `winner: animation, sound`. The command asks for them too.
5. Once the animations have team members, turn on `'people' => true` under `features` in `config/jam.php`. It adds a page for each participant.

## 5. Rules

- **Never write the topic into a file in this repository before its release.** The repository is public. The build stops if `topic:` is in a YAML file before `topic_release`.
- Everything on `main` is live. Use a pull request when you are unsure.
- Only add photos you have the rights to, and only of people who agreed to be shown.

## 6. Updates and help

Dependabot checks for updates once a week and opens at most one pull request each for `composer` (PHP packages and the engine), `npm` and `actions` (the shared workflow of the engine). A new engine version comes as two of them, `composer` and `actions`: merge both, so that package and workflow match. Check the preview of each pull request before merging.

Use `php hyde list jam` to see all commands. For problems or ideas that concern the engine, open an issue in the [engine repository](https://github.com/Hagenberg-Jams/jam-engine/issues).
