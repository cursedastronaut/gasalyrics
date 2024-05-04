# GasaLyrics - 가사Lyrics
It's a website to display songs.

## Installation
### Requirements
This website runs on the french ISP's server ("Free"). Since this service comes with the ISP for free, and it has been used for small websites since 2008, the requirements are quite outdated.
- PHP `4.4.3-dev`
- MySQL `5.0.83`
- Apache MySQL client `5.1.61`

### Get started
1. Clone the repository in the website folder you desire
```sh
git clone https://github.com/cursedastronaut/gasalyrics.git
cd gasalyrics
```
2. Create `res/php/config.php` by copying its example.
```sh
cp res/php/config_example.php res/php/config.php
```
3. Edit it so it corresponds to your installation.
```php
<?php
	//The MySQL URL of your installation
	define("GASALYRICS_URL",		"example.com:3306");
	//The username of the user who has write access
	//to the specific database GasaLyrics is going
	//to use. (root, for instance).
	define("GASALYRICS_DBUSERNAME",	"username");
	//The password of the user.
	define("GASALYRICS_DBPASSWORD",	"password");
	//The name of the database. You must create it
	//yourself, the installation script won't.
	define("GASALYRICS_DBNAME",		"gasalyrics");
	//The web URL of GasaLyrics. It is used for <meta> tags.
	define("GASALYRICS_WEBURL",		"http://example.com/gasa/"); //The slash at the end is important!

?>
```
4. Go to your website, on the `install.php` web page. (Example: [http://localhost/gasalyrics/install.php](http://localhost/gasalyrics/install.php))
5. Enter the username and password you entered in `config.php`, this is to verify it is not someone else installing.
Done!

### First steps
- Add an Album (`add_album.php`);
- Add a song (`add.php`);
- Edit a song (`manage.php`);


## Database
The database is formed this way:
![Conceptual data model](res/sql/mcd.png)
### Data Definition Language
#### Album Table
| Name          | Description                   |
|---------------|-------------------------------|
| idAlbum       | Album Table's Identifier      |
| titleAlbum    | Title of the Album            |
| shortTitle    | Shorter title of the Album    |
| IconLinkAlbum | Link to an icon of the Album. |

#### Songs Table
| Name               | Description                   |
|--------------------|-------------------------------|
| idSongs            | Songs Table's Identifier      |
| titleSongs         | Title of the song in english  |
| albumIdSongs       | Identifier of its Album       |
| titleOriginalSongs | Original title of the song. Should stay empty if it is the same as the english title |

#### Lyrics Table
| Name               | Description                   |
|--------------------|-------------------------------|
| idLyrics           | Lyrics Table's Identifier     |
| langLyrics         | Language of the lyrics, expressed through two characters being the language code ISO 639-1. (Example: English = en; French = fr). `ins` is used as "Instrumental". |
| contentLyrics      | Content of the Lyrics         |
| idSongsLyrics      | Identifier of the song its the lyrics of |

#### Symlink Table
| Name               | Description                        |
|--------------------|------------------------------------|
| idSymlink          | Symlink Table's Identifier         |
| idAlbum            | Identifier of its album            |
| idSymlink          | Identifier of the song it links to |

#### Languages Table
#### Symlink Table
| Name               | Description                        |
|--------------------|------------------------------------|
| idLang             | Languages Table's Identifier       |
| langLyrics         | Language's ISO 639-1 code. (Example: English = en; French = fr). `ins` is used as "Instrumental".       |
| nameLang           | Name of the language               |