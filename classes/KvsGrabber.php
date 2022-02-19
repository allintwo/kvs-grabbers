<?php
/* © Kernel Video Sharing
   https://kernel-video-sharing.com
*/

/** @noinspection PhpUnusedParameterInspection, ReturnTypeCanBeDeclaredInspection, AccessModifierPresentedInspection */

define('KVS_GRABBER_API', 520);

class KvsGrabberCommentInfo
{
	private $comment = '';
	private $author = '';
	private $date = 0;
	private $likes = 0;
	private $dislikes = 0;

	/**
	 * @return string
	 */
	public function get_comment()
	{
		return $this->comment;
	}

	/**
	 * @param string $comment
	 */
	public function set_comment($comment)
	{
		$this->comment = trim($comment);
	}

	/**
	 * @return string
	 */
	public function get_author()
	{
		return $this->author;
	}

	/**
	 * @param string $author
	 */
	public function set_author($author)
	{
		$this->author = trim($author);
	}

	/**
	 * @return int
	 */
	public function get_date()
	{
		return $this->date;
	}

	/**
	 * @param int $date
	 */
	public function set_date($date)
	{
		$this->date = intval($date);
	}

	/**
	 * @return int
	 */
	public function get_likes()
	{
		return $this->likes;
	}

	/**
	 * @param int $likes
	 */
	public function set_likes($likes)
	{
		$this->likes = intval($likes);
	}

	/**
	 * @return int
	 */
	public function get_dislikes()
	{
		return $this->dislikes;
	}

	/**
	 * @param int $dislikes
	 */
	public function set_dislikes($dislikes)
	{
		$this->dislikes = intval($dislikes);
	}
}

abstract class KvsGrabberInfo
{
	const ERROR_CODE_PAGE_UNAVAILABLE = 1;
	const ERROR_CODE_PAGE_ERROR = 2;
	const ERROR_CODE_PARSING_ERROR = 3;
	const ERROR_CODE_UNEXPECTED_ERROR = 4;

	private $error_code = 0;
	private $error_message = '';

	private $canonical = '';
	private $title = '';
	private $description = '';
	private $categories = [];
	private $tags = [];
	private $models = [];
	private $content_source = '';
	private $date = 0;
	private $views = 0;
	private $rating = 0;
	private $votes = 0;
	private $custom_fields = [];
	private $user = '';

	private $comments = [];

	/**
	 * @param int $code
	 * @param string $message
	 */
	public function log_error($code, $message)
	{
		$this->error_code = $code;
		$this->error_message = $message;
	}

	/**
	 * @return int
	 */
	public function get_error_code()
	{
		return $this->error_code;
	}

	/**
	 * @return string
	 */
	public function get_error_message()
	{
		return $this->error_message;
	}

	/**
	 * @param string $canonical
	 */
	public function set_canonical($canonical)
	{
		$this->canonical = trim($canonical);
	}

	/**
	 * @return string
	 */
	public function get_canonical()
	{
		return $this->canonical;
	}

	/**
	 * @param string $title
	 */
	public function set_title($title)
	{
		$this->title = trim($title);
	}

	/**
	 * @return string
	 */
	public function get_title()
	{
		return $this->title;
	}

	/**
	 * @param string $description
	 */
	public function set_description($description)
	{
		$this->description = trim($description);
	}

	/**
	 * @return string
	 */
	public function get_description()
	{
		return $this->description;
	}

	/**
	 * @param string $category
	 */
	public function add_category($category)
	{
		$this->categories[] = trim($category);
	}

	/**
	 * @return array
	 */
	public function get_categories()
	{
		return $this->categories;
	}

	/**
	 * @param string $tag
	 */
	public function add_tag($tag)
	{
		$this->tags[] = strtolower(trim($tag));
	}

	/**
	 * @return array
	 */
	public function get_tags()
	{
		return $this->tags;
	}

	/**
	 * @param string $model
	 */
	public function add_model($model)
	{
		$this->models[] = trim($model);
	}

	/**
	 * @return array
	 */
	public function get_models()
	{
		return $this->models;
	}

	/**
	 * @param string $content_source
	 */
	public function set_content_source($content_source)
	{
		$this->content_source = trim($content_source);
	}

	/**
	 * @return string
	 */
	public function get_content_source()
	{
		return $this->content_source;
	}

	/**
	 * @param int $date
	 */
	public function set_date($date)
	{
		$this->date = intval($date);
	}

	/**
	 * @return int
	 */
	public function get_date()
	{
		return $this->date;
	}

	/**
	 * @param int $views
	 */
	public function set_views($views)
	{
		$this->views = intval($views);
	}

	/**
	 * @return int
	 */
	public function get_views()
	{
		return $this->views;
	}

	/**
	 * @param int $rating
	 */
	public function set_rating($rating)
	{
		$this->rating = intval($rating);
		if ($this->rating > 100)
		{
			$this->rating = 100;
		}
	}

	/**
	 * @return int
	 */
	public function get_rating()
	{
		return $this->rating;
	}

	/**
	 * @param int $votes
	 */
	public function set_votes($votes)
	{
		$this->votes = intval($votes);
	}

	/**
	 * @return int
	 */
	public function get_votes()
	{
		return $this->votes;
	}

	/**
	 * @param int $index
	 * @param string $value
	 */
	public function add_custom_field($index, $value)
	{
		$this->custom_fields["custom{$index}"] = trim($value);
	}

	/**
	 * @param int $index
	 *
	 * @return string
	 */
	public function get_custom_field($index)
	{
		return $this->custom_fields["custom{$index}"];
	}

	/**
	 * @return string
	 */
	public function get_user()
	{
		return $this->user;
	}

	/**
	 * @param string $user
	 */
	public function set_user($user)
	{
		$this->user = trim($user);
	}

	/**
	 * @param KvsGrabberCommentInfo $comment
	 */
	public function add_comment(KvsGrabberCommentInfo $comment)
	{
		$this->comments[] = $comment;
	}

	/**
	 * @return KvsGrabberCommentInfo[]
	 */
	public function get_comments()
	{
		return $this->comments;
	}

	public function categories_to_tags()
	{
		foreach ($this->categories as $category)
		{
			$category = strtolower($category);
			if (!in_array($category, $this->tags))
			{
				$this->add_tag($category);
			}
		}
		$this->categories = [];
	}
}

class KvsGrabberVideoInfo extends KvsGrabberInfo
{
	private $channel = '';
	private $duration = 0;
	private $embed = '';
	private $screenshot = '';
	private $video_files = [];
	private $additional_data = [];

	/**
	 * @param string $content_source
	 */
	public function set_content_source($content_source)
	{
		parent::set_content_source($content_source);
		$this->set_channel($content_source);
	}

	/**
	 * @param string $channel
	 */
	public function set_channel($channel)
	{
		$this->channel = trim($channel);
	}

	/**
	 * @return string
	 */
	public function get_channel()
	{
		return $this->channel;
	}

	/**
	 * @param int $duration
	 */
	public function set_duration($duration)
	{
		$this->duration = intval($duration);
	}

	/**
	 * @return int
	 */
	public function get_duration()
	{
		return $this->duration;
	}

	/**
	 * @param string $embed
	 */
	public function set_embed($embed)
	{
		$this->embed = trim($embed);
	}

	/**
	 * @return string
	 */
	public function get_embed()
	{
		return $this->embed;
	}

	/**
	 * @param string $screenshot
	 */
	public function set_screenshot($screenshot)
	{
		$this->screenshot = trim($screenshot);
	}

	/**
	 * @return string
	 */
	public function get_screenshot()
	{
		return $this->screenshot;
	}

	/**
	 * @param string $quality
	 * @param string $video_file
	 */
	public function add_video_file($quality, $video_file)
	{
		if (trim($video_file) != '')
		{
			$this->video_files[$quality] = trim($video_file);
		}
	}

	/**
	 * @return array
	 */
	public function get_video_files()
	{
		return $this->video_files;
	}

	/**
	 * @param array $additional_data
	 */
	public function set_additional_data($additional_data)
	{
		$this->additional_data = $additional_data;
	}

	/**
	 * @return array
	 */
	public function get_additional_data()
	{
		return $this->additional_data;
	}
}

class KvsGrabberAlbumInfo extends KvsGrabberInfo
{
	private $image_files = [];

	/**
	 * @param string $image_file
	 */
	public function add_image_file($image_file)
	{
		if (trim($image_file) != '')
		{
			if (!in_array(trim($image_file), $this->image_files))
			{
				$this->image_files[] = trim($image_file);
			}
		}
	}

	/**
	 * @return array
	 */
	public function get_image_files()
	{
		return $this->image_files;
	}
}

class KvsGrabberModelInfo extends KvsGrabberInfo
{
	const GENDER_FEMALE = 0;
	const GENDER_MALE = 1;
	const GENDER_OTHER = 2;

	private $pseudonyms = '';
	private $height = '';
	private $weight = '';
	private $measurements = '';
	private $country = '';
	private $city = '';
	private $state = '';
	private $gender = 0;
	private $eye_color = '';
	private $hair_color = '';
	private $birth_date = 0;
	private $age = 0;
	private $screenshot = '';

	/**
	 * @param string $pseudonyms
	 */
	public function set_pseudonyms($pseudonyms)
	{
		$this->pseudonyms = trim($pseudonyms);
	}

	/**
	 * @return string
	 */
	public function get_pseudonyms()
	{
		return $this->pseudonyms;
	}

	/**
	 * @param string $height
	 */
	public function set_height($height)
	{
		$this->height = trim($height);
	}

	/**
	 * @return string
	 */
	public function get_height()
	{
		return $this->height;
	}

	/**
	 * @param string $weight
	 */
	public function set_weight($weight)
	{
		$this->weight = trim($weight);
	}

	/**
	 * @return string
	 */
	public function get_weight()
	{
		return $this->weight;
	}

	/**
	 * @param string $measurements
	 */
	public function set_measurements($measurements)
	{
		$this->measurements = trim($measurements);
	}

	/**
	 * @return string
	 */
	public function get_measurements()
	{
		return $this->measurements;
	}

	/**
	 * @param string $country
	 */
	public function set_country($country)
	{
		$this->country = trim($country);
	}

	/**
	 * @return string
	 */
	public function get_country()
	{
		return $this->country;
	}

	/**
	 * @param string $city
	 */
	public function set_city($city)
	{
		$this->city = trim($city);
	}

	/**
	 * @return string
	 */
	public function get_city()
	{
		return $this->city;
	}

	/**
	 * @param string $state
	 */
	public function set_state($state)
	{
		$this->state = trim($state);
	}

	/**
	 * @return string
	 */
	public function get_state()
	{
		return $this->state;
	}

	/**
	 * @param int $gender
	 */
	public function set_gender($gender)
	{
		$this->gender = intval($gender);
		if (!in_array($this->gender, array(self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_OTHER)))
		{
			$this->gender = 0;
		}
	}

	/**
	 * @return int
	 */
	public function get_gender()
	{
		return $this->gender;
	}

	/**
	 * @param string $eye_color
	 */
	public function set_eye_color($eye_color)
	{
		$this->eye_color = trim($eye_color);
	}

	/**
	 * @return string
	 */
	public function get_eye_color()
	{
		return $this->eye_color;
	}

	/**
	 * @param string $hair_color
	 */
	public function set_hair_color($hair_color)
	{
		$this->hair_color = trim($hair_color);
	}

	/**
	 * @return string
	 */
	public function get_hair_color()
	{
		return $this->hair_color;
	}

	/**
	 * @param int $birth_date
	 */
	public function set_birth_date($birth_date)
	{
		$this->birth_date = intval($birth_date);
	}

	/**
	 * @return int
	 */
	public function get_birth_date()
	{
		return $this->birth_date;
	}

	/**
	 * @param int $age
	 */
	public function set_age($age)
	{
		if (intval($age) > 0 && intval($age) < 80)
		{
			$this->age = intval($age);
		}
	}

	/**
	 * @return int
	 */
	public function get_age()
	{
		return $this->age;
	}

	/**
	 * @param string $screenshot
	 */
	public function set_screenshot($screenshot)
	{
		$this->screenshot = trim($screenshot);
	}

	/**
	 * @return string
	 */
	public function get_screenshot()
	{
		return $this->screenshot;
	}
}

class KvsGrabberListResult
{
	const ERROR_CODE_PAGE_UNAVAILABLE = 1;
	const ERROR_CODE_UNEXPECTED_ERROR = 4;

	private $error_code = 0;
	private $error_message = '';
	private $content_pages = [];

	/**
	 * @param int $code
	 * @param string $message
	 */
	public function log_error($code, $message)
	{
		$this->error_code = $code;
		$this->error_message = $message;
	}

	/**
	 * @return int
	 */
	public function get_error_code()
	{
		return $this->error_code;
	}

	/**
	 * @return string
	 */
	public function get_error_message()
	{
		return $this->error_message;
	}

	/**
	 * @param string $content_page
	 */
	public function add_content_page($content_page)
	{
		$this->content_pages[md5($content_page)] = $content_page;
	}

	/**
	 * @return array
	 */
	public function get_content_pages()
	{
		return $this->content_pages;
	}
}

class KvsGrabberSettings
{
	const GRAB_MODE_DOWNLOAD = 'download';
	const GRAB_MODE_EMBED = 'embed';
	const GRAB_MODE_PSEUDO = 'pseudo';

	const DATA_FIELD_TITLE = 'title';
	const DATA_FIELD_DESCRIPTION = 'description';
	const DATA_FIELD_CATEGORIES = 'categories';
	const DATA_FIELD_TAGS = 'tags';
	const DATA_FIELD_MODELS = 'models';
	const DATA_FIELD_CONTENT_SOURCE = 'content_source';
	const DATA_FIELD_CHANNEL = 'channel';
	const DATA_FIELD_SCREENSHOT = 'screenshot';
	const DATA_FIELD_RATING = 'rating';
	const DATA_FIELD_VIEWS = 'views';
	const DATA_FIELD_DATE = 'date';
	const DATA_FIELD_GENDER = 'gender';
	const DATA_FIELD_AGE = 'age';
	const DATA_FIELD_BIRTH_DATE = 'birth_date';
	const DATA_FIELD_PSEUDOMYNS = 'pseudonyms';
	const DATA_FIELD_HEIGHT = 'height';
	const DATA_FIELD_WEIGHT = 'weight';
	const DATA_FIELD_MEASUREMENTS = 'measurements';
	const DATA_FIELD_EYE_COLOR = 'eye_color';
	const DATA_FIELD_HAIR_COLOR = 'hair_color';
	const DATA_FIELD_COUNTRY = 'country';
	const DATA_FIELD_CITY = 'city';
	const DATA_FIELD_STATE = 'state';
	const DATA_FIELD_CUSTOM = 'custom';
	const DATA_FIELD_USER = 'user';
	const DATA_FIELD_COMMENTS = 'comments';

	const QUALITY_MISSING_ERROR = 'error';
	const QUALITY_MISSING_LOWER = 'lower';
	const QUALITY_MISSING_HIGHER = 'higher';

	const TITLE_LIMIT_OPTION_WORDS = 1;
	const TITLE_LIMIT_OPTION_CHARACTERS = 2;

	const DESCRIPTION_LIMIT_OPTION_WORDS = 1;
	const DESCRIPTION_LIMIT_OPTION_CHARACTERS = 2;

	const AUTODELETE_MODE_DELETE = 0;
	const AUTODELETE_MODE_MARK_DELETED = 1;

	private $mode = '';
	private $data = [];
	private $content_source_id = 0;
	private $quality = '';
	private $quality_missing = '';
	private $download_format = '';
	private $download_formats_mapping = [];
	private $filter_quantity_from = 0;
	private $filter_quantity_to = 0;
	private $filter_rating_from = 0;
	private $filter_rating_to = 0;
	private $filter_views_from = 0;
	private $filter_views_to = 0;
	private $filter_date_from = 0;
	private $filter_date_to = 0;
	private $filter_terminology = '';
	private $filter_quality_from = '';
	private $replacements = '';
	private $url_postfix = '';
	private $timeout = 0;
	private $proxies = '';
	private $account = '';
	private $import_categories_as_tags = false;
	private $import_deleted_content = false;

	private $autodelete = false;
	private $autodelete_mode = 0;
	private $autodelete_reason = '';
	private $autodelete_last_exec_time = 0;
	private $autodelete_last_exec_duration = 0;
	private $autodelete_last_exec_deleted = 0;

	private $autopilot = false;
	private $autopilot_interval = 4;
	private $autopilot_last_exec_time = 0;
	private $autopilot_last_exec_duration = 0;
	private $autopilot_last_exec_added = 0;
	private $autopilot_last_exec_duplicates = 0;
	private $autopilot_threads = 0;
	private $autopilot_title_limit = 0;
	private $autopilot_title_limit_option = self::TITLE_LIMIT_OPTION_WORDS;
	private $autopilot_description_limit = 0;
	private $autopilot_description_limit_option = self::DESCRIPTION_LIMIT_OPTION_WORDS;
	private $autopilot_new_content_disabled = false;
	private $autopilot_new_content_admin_flag_id = 0;
	private $autopilot_skip_duplicate_titles = false;
	private $autopilot_skip_new_categories = false;
	private $autopilot_skip_new_models = false;
	private $autopilot_skip_new_content_sources = false;
	private $autopilot_skip_new_channels = false;
	private $autopilot_review_needed = false;
	private $autopilot_randomize_time = false;
	private $autopilot_urls = '';

	private $broken = false;
	private $order = 0;

	/**
	 * @param string $mode
	 */
	public function set_mode($mode)
	{
		$this->mode = $mode;
		if (!in_array($this->mode, array(self::GRAB_MODE_DOWNLOAD, self::GRAB_MODE_PSEUDO, self::GRAB_MODE_EMBED)))
		{
			$this->mode = '';
		}
	}

	/**
	 * @return string
	 */
	public function get_mode()
	{
		return $this->mode;
	}

	/**
	 *
	 */
	public function clear_data()
	{
		$this->data = [];
	}

	/**
	 * @param string $data
	 */
	public function add_data($data)
	{
		$this->data[] = $data;
	}

	/**
	 * @return array
	 */
	public function get_data()
	{
		return $this->data;
	}

	/**
	 * @param int $content_source_id
	 */
	public function set_content_source_id($content_source_id)
	{
		$this->content_source_id = intval($content_source_id);
	}

	/**
	 * @return int
	 */
	public function get_content_source_id()
	{
		return $this->content_source_id;
	}

	/**
	 * @param string $quality
	 */
	public function set_quality($quality)
	{
		$this->quality = $quality;
	}

	/**
	 * @return string
	 */
	public function get_quality()
	{
		return $this->quality;
	}

	/**
	 * @param string $quality_missing
	 */
	public function set_quality_missing($quality_missing)
	{
		$this->quality_missing = $quality_missing;
		if (!in_array($this->quality_missing, array(self::QUALITY_MISSING_ERROR, self::QUALITY_MISSING_HIGHER, self::QUALITY_MISSING_LOWER)))
		{
			$this->quality_missing = self::QUALITY_MISSING_ERROR;
		}
	}

	/**
	 * @return string
	 */
	public function get_quality_missing()
	{
		return $this->quality_missing;
	}

	/**
	 * @param string $download_format
	 */
	public function set_download_format($download_format)
	{
		$this->download_format = $download_format;
	}

	/**
	 * @return string
	 */
	public function get_download_format()
	{
		return $this->download_format;
	}

	/**
	 *
	 */
	public function clear_download_formats_mapping()
	{
		$this->download_formats_mapping = [];
	}

	/**
	 * @param string $source_format
	 * @param string $target_format
	 */
	public function add_download_format_mapping($source_format, $target_format)
	{
		$this->download_formats_mapping[$source_format] = $target_format;
	}

	/**
	 * @return array
	 */
	public function get_download_formats_mapping()
	{
		return $this->download_formats_mapping;
	}

	/**
	 * @param int $filter_quantity_from
	 */
	public function set_filter_quantity_from($filter_quantity_from)
	{
		$this->filter_quantity_from = intval($filter_quantity_from);
	}

	/**
	 * @return int
	 */
	public function get_filter_quantity_from()
	{
		return $this->filter_quantity_from;
	}

	/**
	 * @param int $filter_quantity_to
	 */
	public function set_filter_quantity_to($filter_quantity_to)
	{
		$this->filter_quantity_to = intval($filter_quantity_to);
	}

	/**
	 * @return int
	 */
	public function get_filter_quantity_to()
	{
		return $this->filter_quantity_to;
	}

	/**
	 * @param int $filter_rating_from
	 */
	public function set_filter_rating_from($filter_rating_from)
	{
		$this->filter_rating_from = intval($filter_rating_from);
	}

	/**
	 * @return int
	 */
	public function get_filter_rating_from()
	{
		return $this->filter_rating_from;
	}

	/**
	 * @param int $filter_rating_to
	 */
	public function set_filter_rating_to($filter_rating_to)
	{
		$this->filter_rating_to = intval($filter_rating_to);
	}

	/**
	 * @return int
	 */
	public function get_filter_rating_to()
	{
		return $this->filter_rating_to;
	}

	/**
	 * @param int $filter_views_from
	 */
	public function set_filter_views_from($filter_views_from)
	{
		$this->filter_views_from = intval($filter_views_from);
	}

	/**
	 * @return int
	 */
	public function get_filter_views_from()
	{
		return $this->filter_views_from;
	}

	/**
	 * @param int $filter_views_to
	 */
	public function set_filter_views_to($filter_views_to)
	{
		$this->filter_views_to = intval($filter_views_to);
	}

	/**
	 * @return int
	 */
	public function get_filter_views_to()
	{
		return $this->filter_views_to;
	}

	/**
	 * @param int $filter_date_from
	 */
	public function set_filter_date_from($filter_date_from)
	{
		$this->filter_date_from = intval($filter_date_from);
	}

	/**
	 * @return int
	 */
	public function get_filter_date_from()
	{
		return $this->filter_date_from;
	}

	/**
	 * @param int $filter_date_to
	 */
	public function set_filter_date_to($filter_date_to)
	{
		$this->filter_date_to = intval($filter_date_to);
	}

	/**
	 * @return int
	 */
	public function get_filter_date_to()
	{
		return $this->filter_date_to;
	}

	/**
	 * @param string $filter_terminology
	 */
	public function set_filter_terminology($filter_terminology)
	{
		$this->filter_terminology = trim($filter_terminology);
	}

	/**
	 * @return string
	 */
	public function get_filter_terminology()
	{
		return $this->filter_terminology;
	}

	/**
	 * @param string $filter_quality_from
	 */
	public function set_filter_quality_from($filter_quality_from)
	{
		$this->filter_quality_from = trim($filter_quality_from);
	}

	/**
	 * @return string
	 */
	public function get_filter_quality_from()
	{
		return $this->filter_quality_from;
	}

	/**
	 * @param string $replacements
	 */
	public function set_replacements($replacements)
	{
		$this->replacements = $replacements;
	}

	/**
	 * @return string
	 */
	public function get_replacements()
	{
		return $this->replacements;
	}

	/**
	 * @param string $proxies
	 */
	public function set_proxies($proxies)
	{
		$this->proxies = trim($proxies);
	}

	/**
	 * @return string
	 */
	public function get_proxies()
	{
		return $this->proxies;
	}

	/**
	 * @param string $account
	 */
	public function set_account($account)
	{
		$this->account = trim($account);
	}

	/**
	 * @return string
	 */
	public function get_account()
	{
		return $this->account;
	}

	/**
	 * @param string $url_postfix
	 */
	public function set_url_postfix($url_postfix)
	{
		$this->url_postfix = trim($url_postfix, '&? ');
	}

	/**
	 * @return string
	 */
	public function get_url_postfix()
	{
		return $this->url_postfix;
	}

	/**
	 * @param int $timeout
	 */
	public function set_timeout($timeout)
	{
		$this->timeout = intval($timeout);
	}

	/**
	 * @return int
	 */
	public function get_timeout()
	{
		return $this->timeout;
	}

	/**
	 * @param bool $import_categories_as_tags
	 */
	public function set_import_categories_as_tags($import_categories_as_tags)
	{
		$this->import_categories_as_tags = $import_categories_as_tags;
	}

	/**
	 * @return bool
	 */
	public function is_import_categories_as_tags()
	{
		return $this->import_categories_as_tags;
	}

	/**
	 * @param bool $import_deleted_content
	 */
	public function set_import_deleted_content($import_deleted_content)
	{
		$this->import_deleted_content = $import_deleted_content;
	}

	/**
	 * @return bool
	 */
	public function is_import_deleted_content()
	{
		return $this->import_deleted_content;
	}

	/**
	 * @param bool $autodelete
	 */
	public function set_autodelete($autodelete)
	{
		$this->autodelete = $autodelete;
	}

	/**
	 * @return bool
	 */
	public function is_autodelete()
	{
		return $this->autodelete;
	}

	/**
	 * @param int $autodelete_mode
	 */
	public function set_autodelete_mode($autodelete_mode)
	{
		$this->autodelete_mode = intval($autodelete_mode);
	}

	/**
	 * @return int
	 */
	public function get_autodelete_mode()
	{
		return $this->autodelete_mode;
	}

	/**
	 * @param string $autodelete_reason
	 */
	public function set_autodelete_reason($autodelete_reason)
	{
		$this->autodelete_reason = trim($autodelete_reason);
	}

	/**
	 * @return string
	 */
	public function get_autodelete_reason()
	{
		return $this->autodelete_reason;
	}

	/**
	 * @param int $autodelete_last_exec_time
	 */
	public function set_autodelete_last_exec_time($autodelete_last_exec_time)
	{
		$this->autodelete_last_exec_time = intval($autodelete_last_exec_time);
	}

	/**
	 * @return int
	 */
	public function get_autodelete_last_exec_time()
	{
		return $this->autodelete_last_exec_time;
	}

	/**
	 * @param int $autodelete_last_exec_duration
	 */
	public function set_autodelete_last_exec_duration($autodelete_last_exec_duration)
	{
		$this->autodelete_last_exec_duration = intval($autodelete_last_exec_duration);
	}

	/**
	 * @return int
	 */
	public function get_autodelete_last_exec_duration()
	{
		return $this->autodelete_last_exec_duration;
	}

	/**
	 * @param int $autodelete_last_exec_deleted
	 */
	public function set_autodelete_last_exec_deleted($autodelete_last_exec_deleted)
	{
		$this->autodelete_last_exec_deleted = intval($autodelete_last_exec_deleted);
	}

	/**
	 * @return int
	 */
	public function get_autodelete_last_exec_deleted()
	{
		return $this->autodelete_last_exec_deleted;
	}

	/**
	 * @param bool $autopilot
	 */
	public function set_autopilot($autopilot)
	{
		$this->autopilot = $autopilot;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot()
	{
		return $this->autopilot;
	}

	/**
	 * @param int $autopilot_interval
	 */
	public function set_autopilot_interval($autopilot_interval)
	{
		$this->autopilot_interval = intval($autopilot_interval);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_interval()
	{
		return $this->autopilot_interval;
	}

	/**
	 * @param int $autopilot_last_exec_time
	 */
	public function set_autopilot_last_exec_time($autopilot_last_exec_time)
	{
		$this->autopilot_last_exec_time = intval($autopilot_last_exec_time);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_last_exec_time()
	{
		return $this->autopilot_last_exec_time;
	}

	/**
	 * @param int $autopilot_last_exec_duration
	 */
	public function set_autopilot_last_exec_duration($autopilot_last_exec_duration)
	{
		$this->autopilot_last_exec_duration = intval($autopilot_last_exec_duration);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_last_exec_duration()
	{
		return $this->autopilot_last_exec_duration;
	}

	/**
	 * @param int $autopilot_last_exec_added
	 */
	public function set_autopilot_last_exec_added($autopilot_last_exec_added)
	{
		$this->autopilot_last_exec_added = intval($autopilot_last_exec_added);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_last_exec_added()
	{
		return $this->autopilot_last_exec_added;
	}

	/**
	 * @param int $autopilot_last_exec_duplicates
	 */
	public function set_autopilot_last_exec_duplicates($autopilot_last_exec_duplicates)
	{
		$this->autopilot_last_exec_duplicates = intval($autopilot_last_exec_duplicates);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_last_exec_duplicates()
	{
		return $this->autopilot_last_exec_duplicates;
	}

	/**
	 * @param int $autopilot_threads
	 */
	public function set_autopilot_threads($autopilot_threads)
	{
		$this->autopilot_threads = intval($autopilot_threads);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_threads()
	{
		return $this->autopilot_threads;
	}

	/**
	 * @param int $autopilot_title_limit
	 */
	public function set_autopilot_title_limit($autopilot_title_limit)
	{
		$this->autopilot_title_limit = intval($autopilot_title_limit);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_title_limit()
	{
		return $this->autopilot_title_limit;
	}

	/**
	 * @param int $autopilot_title_limit_option
	 */
	public function set_autopilot_title_limit_option($autopilot_title_limit_option)
	{
		if (in_array($autopilot_title_limit_option, array(self::TITLE_LIMIT_OPTION_CHARACTERS, self::TITLE_LIMIT_OPTION_WORDS)))
		{
			$this->autopilot_title_limit_option = $autopilot_title_limit_option;
		}
	}

	/**
	 * @return int
	 */
	public function get_autopilot_title_limit_option()
	{
		return $this->autopilot_title_limit_option;
	}

	/**
	 * @param int $autopilot_description_limit
	 */
	public function set_autopilot_description_limit($autopilot_description_limit)
	{
		$this->autopilot_description_limit = intval($autopilot_description_limit);
	}

	/**
	 * @return int
	 */
	public function get_autopilot_description_limit()
	{
		return $this->autopilot_description_limit;
	}

	/**
	 * @param int $autopilot_description_limit_option
	 */
	public function set_autopilot_description_limit_option($autopilot_description_limit_option)
	{
		if (in_array($autopilot_description_limit_option, array(self::DESCRIPTION_LIMIT_OPTION_CHARACTERS, self::DESCRIPTION_LIMIT_OPTION_WORDS)))
		{
			$this->autopilot_description_limit_option = $autopilot_description_limit_option;
		}
	}

	/**
	 * @return int
	 */
	public function get_autopilot_description_limit_option()
	{
		return $this->autopilot_description_limit_option;
	}

	/**
	 * @param bool $autopilot_new_content_disabled
	 */
	public function set_autopilot_new_content_disabled($autopilot_new_content_disabled)
	{
		$this->autopilot_new_content_disabled = $autopilot_new_content_disabled;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_new_content_disabled()
	{
		return $this->autopilot_new_content_disabled;
	}

	/**
	 * @param int $autopilot_new_content_admin_flag_id
	 */
	public function set_autopilot_new_content_admin_flag_id($autopilot_new_content_admin_flag_id)
	{
		$this->autopilot_new_content_admin_flag_id = $autopilot_new_content_admin_flag_id;
	}

	/**
	 * @return int
	 */
	public function get_autopilot_new_content_admin_flag_id()
	{
		return $this->autopilot_new_content_admin_flag_id;
	}

	/**
	 * @param bool $autopilot_skip_duplicate_titles
	 */
	public function set_autopilot_skip_duplicate_titles($autopilot_skip_duplicate_titles)
	{
		$this->autopilot_skip_duplicate_titles = $autopilot_skip_duplicate_titles;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_skip_duplicate_titles()
	{
		return $this->autopilot_skip_duplicate_titles;
	}

	/**
	 * @param bool $autopilot_skip_new_categories
	 */
	public function set_autopilot_skip_new_categories($autopilot_skip_new_categories)
	{
		$this->autopilot_skip_new_categories = $autopilot_skip_new_categories;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_skip_new_categories()
	{
		return $this->autopilot_skip_new_categories;
	}

	/**
	 * @param bool $autopilot_skip_new_models
	 */
	public function set_autopilot_skip_new_models($autopilot_skip_new_models)
	{
		$this->autopilot_skip_new_models = $autopilot_skip_new_models;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_skip_new_models()
	{
		return $this->autopilot_skip_new_models;
	}

	/**
	 * @param bool $autopilot_skip_new_content_sources
	 */
	public function set_autopilot_skip_new_content_sources($autopilot_skip_new_content_sources)
	{
		$this->autopilot_skip_new_content_sources = $autopilot_skip_new_content_sources;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_skip_new_content_sources()
	{
		return $this->autopilot_skip_new_content_sources;
	}

	/**
	 * @param bool $autopilot_skip_new_channels
	 */
	public function set_autopilot_skip_new_channels($autopilot_skip_new_channels)
	{
		$this->autopilot_skip_new_channels = $autopilot_skip_new_channels;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_skip_new_channels()
	{
		return $this->autopilot_skip_new_channels;
	}

	/**
	 * @param bool $autopilot_review_needed
	 */
	public function set_autopilot_review_needed($autopilot_review_needed)
	{
		$this->autopilot_review_needed = $autopilot_review_needed;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_review_needed()
	{
		return $this->autopilot_review_needed;
	}

	/**
	 * @param bool $autopilot_randomize_time
	 */
	public function set_autopilot_randomize_time($autopilot_randomize_time)
	{
		$this->autopilot_randomize_time = $autopilot_randomize_time;
	}

	/**
	 * @return bool
	 */
	public function is_autopilot_randomize_time()
	{
		return $this->autopilot_randomize_time;
	}

	/**
	 * @param string $autopilot_urls
	 */
	public function set_autopilot_urls($autopilot_urls)
	{
		$this->autopilot_urls = trim($autopilot_urls);
	}

	/**
	 * @return string
	 */
	public function get_autopilot_urls()
	{
		return $this->autopilot_urls;
	}

	/**
	 * @param bool $broken
	 */
	public function set_broken($broken)
	{
		$this->broken = $broken;
	}

	/**
	 * @return bool
	 */
	public function is_broken()
	{
		return $this->broken;
	}

	/**
	 * @param int $order
	 */
	public function set_order($order)
	{
		$this->order = $order;
	}

	/**
	 * @return int
	 */
	public function get_order()
	{
		return $this->order;
	}

	/**
	 * @return array
	 */
	public function to_array()
	{
		return array(
				'mode' => $this->mode,
				'data' => $this->data,
				'content_source_id' => $this->content_source_id,
				'quality' => $this->quality,
				'quality_missing' => $this->quality_missing,
				'download_format' => $this->download_format,
				'download_formats_mapping' => $this->download_formats_mapping,
				'filter_quantity_from' => $this->filter_quantity_from,
				'filter_quantity_to' => $this->filter_quantity_to,
				'filter_rating_from' => $this->filter_rating_from,
				'filter_rating_to' => $this->filter_rating_to,
				'filter_views_from' => $this->filter_views_from,
				'filter_views_to' => $this->filter_views_to,
				'filter_date_from' => $this->filter_date_from,
				'filter_date_to' => $this->filter_date_to,
				'filter_terminology' => $this->filter_terminology,
				'filter_quality_from' => $this->filter_quality_from,
				'replacements' => $this->replacements,
				'url_postfix' => $this->url_postfix,
				'timeout' => $this->timeout,
				'proxies' => $this->proxies,
				'account' => $this->account,
				'is_import_categories_as_tags' => $this->import_categories_as_tags ? 1 : 0,
				'is_import_deleted_content' => $this->import_deleted_content ? 1 : 0,
				'is_autodelete' => $this->autodelete ? 1 : 0,
				'autodelete_mode' => $this->autodelete_mode,
				'autodelete_reason' => $this->autodelete_reason,
				'autodelete_last_exec_time' => $this->autodelete_last_exec_time,
				'autodelete_last_exec_duration' => $this->autodelete_last_exec_duration,
				'autodelete_last_exec_deleted' => $this->autodelete_last_exec_deleted,
				'is_autopilot' => $this->autopilot ? 1 : 0,
				'autopilot_interval' => $this->autopilot_interval,
				'autopilot_last_exec_time' => $this->autopilot_last_exec_time,
				'autopilot_last_exec_duration' => $this->autopilot_last_exec_duration,
				'autopilot_last_exec_added' => $this->autopilot_last_exec_added,
				'autopilot_last_exec_duplicates' => $this->autopilot_last_exec_duplicates,
				'threads' => $this->autopilot_threads,
				'title_limit' => $this->autopilot_title_limit,
				'title_limit_type_id' => $this->autopilot_title_limit_option,
				'description_limit' => $this->autopilot_description_limit,
				'description_limit_type_id' => $this->autopilot_description_limit_option,
				'status_after_import_id' => $this->autopilot_new_content_disabled ? 1 : 0,
				'admin_flag_id' => $this->autopilot_new_content_admin_flag_id,
				'is_skip_duplicate_titles' => $this->autopilot_skip_duplicate_titles ? 1 : 0,
				'is_skip_new_categories' => $this->autopilot_skip_new_categories ? 1 : 0,
				'is_skip_new_models' => $this->autopilot_skip_new_models ? 1 : 0,
				'is_skip_new_content_sources' => $this->autopilot_skip_new_content_sources ? 1 : 0,
				'is_skip_new_channels' => $this->autopilot_skip_new_channels ? 1 : 0,
				'is_review_needed' => $this->autopilot_review_needed ? 1 : 0,
				'is_randomize_time' => $this->autopilot_randomize_time ? 1 : 0,
				'upload_list' => $this->autopilot_urls,
				'is_broken' => $this->broken ? 1 : 0,
				'order' => $this->order,
		);
	}

	/**
	 * @param array $data
	 */
	public function from_array($data)
	{
		if (is_array($data))
		{
			$this->set_mode($data['mode']);
			$this->set_content_source_id($data['content_source_id']);
			$this->set_quality($data['quality']);
			$this->set_quality_missing($data['quality_missing']);
			$this->set_download_format($data['download_format']);
			$this->set_filter_quantity_from($data['filter_quantity_from']);
			$this->set_filter_quantity_to($data['filter_quantity_to']);
			$this->set_filter_rating_from($data['filter_rating_from']);
			$this->set_filter_rating_to($data['filter_rating_to']);
			$this->set_filter_views_from($data['filter_views_from']);
			$this->set_filter_views_to($data['filter_views_to']);
			$this->set_filter_date_from($data['filter_date_from']);
			$this->set_filter_date_to($data['filter_date_to']);
			$this->set_filter_terminology($data['filter_terminology']);
			$this->set_filter_quality_from($data['filter_quality_from']);
			$this->set_replacements($data['replacements']);
			$this->set_url_postfix($data['url_postfix']);
			$this->set_timeout($data['timeout']);
			$this->set_proxies($data['proxies']);
			$this->set_account($data['account']);
			$this->set_import_categories_as_tags($data['is_import_categories_as_tags'] == 1);
			$this->set_import_deleted_content($data['is_import_deleted_content'] == 1);
			$this->set_autodelete($data['is_autodelete'] == 1);
			$this->set_autodelete_mode($data['autodelete_mode']);
			$this->set_autodelete_reason($data['autodelete_reason']);
			$this->set_autodelete_last_exec_time($data['autodelete_last_exec_time']);
			$this->set_autodelete_last_exec_duration($data['autodelete_last_exec_duration']);
			$this->set_autodelete_last_exec_deleted($data['autodelete_last_exec_deleted']);
			$this->set_autopilot($data['is_autopilot'] == 1);
			$this->set_autopilot_interval($data['autopilot_interval']);
			$this->set_autopilot_last_exec_time($data['autopilot_last_exec_time']);
			$this->set_autopilot_last_exec_duration($data['autopilot_last_exec_duration']);
			$this->set_autopilot_last_exec_added($data['autopilot_last_exec_added']);
			$this->set_autopilot_last_exec_duplicates($data['autopilot_last_exec_duplicates']);
			$this->set_autopilot_threads($data['threads']);
			$this->set_autopilot_title_limit($data['title_limit']);
			$this->set_autopilot_title_limit_option($data['title_limit_type_id']);
			$this->set_autopilot_description_limit($data['description_limit']);
			$this->set_autopilot_description_limit_option($data['description_limit_type_id']);
			$this->set_autopilot_new_content_disabled($data['status_after_import_id'] == 1);
			$this->set_autopilot_new_content_admin_flag_id($data['admin_flag_id']);
			$this->set_autopilot_skip_duplicate_titles($data['is_skip_duplicate_titles'] == 1);
			$this->set_autopilot_skip_new_categories($data['is_skip_new_categories'] == 1);
			$this->set_autopilot_skip_new_models($data['is_skip_new_models'] == 1);
			$this->set_autopilot_skip_new_content_sources($data['is_skip_new_content_sources'] == 1);
			$this->set_autopilot_skip_new_channels($data['is_skip_new_channels'] == 1);
			$this->set_autopilot_review_needed($data['is_review_needed'] == 1);
			$this->set_autopilot_randomize_time($data['is_randomize_time'] == 1);
			$this->set_autopilot_urls($data['upload_list']);
			$this->set_broken($data['is_broken'] == 1);
			$this->set_order($data['order']);

			$this->clear_data();
			foreach ($data['data'] as $data_item)
			{
				$this->add_data($data_item);
			}

			$this->clear_download_formats_mapping();
			foreach ($data['download_formats_mapping'] as $source_format => $target_format)
			{
				$this->add_download_format_mapping($source_format, $target_format);
			}
		}
	}
}

abstract class KvsGrabber
{
	/**
	 * @var bool
	 */
	private $debug = false;

	/**
	 * @var KvsGrabberSettings
	 */
	private $settings;

	/**
	 * @var string
	 */
	private $log;

	/**
	 * @var string
	 */
	protected $proxy;

	/**
	 * @var string
	 */
	protected $working_dir;

	/**
	 * @var mixed
	 */
	protected $progress_callback;

	/**
	 * Inits grabber settings.
	 *
	 * @param KvsGrabberSettings $settings
	 * @param string $working_dir
	 */
	public function init(KvsGrabberSettings $settings, $working_dir)
	{
		$this->settings = $settings;
		$this->working_dir = $working_dir;

		$proxies = $settings->get_proxies();
		if ($proxies)
		{
			$proxies = explode("\n", $proxies);
			if (count($proxies) > 0)
			{
				$this->proxy = trim($proxies[mt_rand(0, count($proxies) - 1)]);
				$this->log_info("Using proxy $this->proxy");
			}
		}
	}

	/**
	 * Sets debug mode.
	 *
	 * @param bool $debug
	 */
	public function set_debug($debug)
	{
		$this->debug = $debug;
	}

	/**
	 * Returns if this grabber is in debug mode.
	 *
	 * @return bool
	 */
	public function is_debug()
	{
		return $this->debug;
	}

	/**
	 * @param mixed $progress_callback
	 */
	public function set_progress_callback($progress_callback)
	{
		$this->progress_callback = $progress_callback;
	}

	/**
	 * Logs message to grabber log.
	 *
	 * @param string $message
	 */
	public function log_info($message)
	{
		if ($message)
		{
			$this->log = trim($this->log . "\n$message");
		}
	}

	/**
	 * Returns grabber log.
	 *
	 * @return string
	 */
	public function get_log()
	{
		return $this->log;
	}

	/**
	 * Returns grabber settings.
	 *
	 * @return KvsGrabberSettings
	 */
	public function get_settings()
	{
		return $this->settings;
	}

	/**
	 * Returns if this grabber is default one.
	 *
	 * @return bool
	 */
	public function is_default()
	{
		return false;
	}

	/**
	 * Returns if this grabber supports ordering.
	 *
	 * @return bool
	 */
	public function is_orderable()
	{
		return false;
	}

	/**
	 * Checks if the given URL is content URL for this grabber.
	 *
	 * @param string $url
	 *
	 * @return bool
	 */
	public function is_content_url($url)
	{
		$patterns = $this->get_supported_url_patterns();
		if ($patterns)
		{
			foreach ($patterns as $pattern)
			{
				if (preg_match($pattern, $url))
				{
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Returns unique grabber ID.
	 *
	 * @return string
	 */
	abstract public function get_grabber_id();

	/**
	 * Returns grabber type.
	 *
	 * @return string
	 */
	abstract public function get_grabber_type();

	/**
	 * Returns grabber name.
	 *
	 * @return string
	 */
	abstract public function get_grabber_name();

	/**
	 * Returns grabber version.
	 *
	 * @return string
	 */
	abstract public function get_grabber_version();

	/**
	 * Returns grabber domain.
	 *
	 * @return string
	 */
	abstract public function get_grabber_domain();

	/**
	 * Returns list of regexp patterns, which can identify if the given URL is supported by this grabber or not.
	 *
	 * @return string[]
	 */
	abstract public function get_supported_url_patterns();

	/**
	 * Returns whether this grabber can grab categories for each object.
	 *
	 * @return bool
	 */
	public function can_grab_categories()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab tags for each object.
	 *
	 * @return bool
	 */
	public function can_grab_tags()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab models for each object.
	 *
	 * @return bool
	 */
	public function can_grab_models()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab content source for each object.
	 *
	 * @return bool
	 */
	public function can_grab_content_source()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab description for each object.
	 *
	 * @return bool
	 */
	public function can_grab_description()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab rating for each object.
	 *
	 * @return bool
	 */
	public function can_grab_rating()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab views for each object.
	 *
	 * @return bool
	 */
	public function can_grab_views()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab date for each object.
	 *
	 * @return bool
	 */
	public function can_grab_date()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab custom fields.
	 *
	 * @return bool
	 */
	public function can_grab_custom()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab username.
	 *
	 * @return bool
	 */
	public function can_grab_user()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab comments.
	 *
	 * @return bool
	 */
	public function can_grab_comments()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab lists with objects.
	 *
	 * @return bool
	 */
	public function can_grab_lists()
	{
		return true;
	}

	/**
	 * Returns whether this grabber can provide URLs that have been deleted.
	 *
	 * @return bool
	 */
	public function can_autodelete()
	{
		return false;
	}

	/**
	 * Returns default grabber settings.
	 *
	 * @return KvsGrabberSettings
	 */
	abstract public function create_default_settings();

	/**
	 * Returns list of supported content modes (e.g. download, embed or pseudo).
	 *
	 * @return array
	 */
	public function get_supported_modes()
	{
		return [];
	}

	/**
	 * Returns list of supported quality names (e.g. 720p, 480p and etc.) in case this grabber supports download. User
	 * then can select the preferred quality to download.
	 *
	 * @return array
	 */
	public function get_supported_qualities()
	{
		return [];
	}

	/**
	 * Returns list of supported fields.
	 *
	 * @return array
	 */
	public function get_supported_data()
	{
		$result = [];
		$result[] = KvsGrabberSettings::DATA_FIELD_TITLE;
		if ($this->can_grab_description())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_DESCRIPTION;
		}
		if ($this->can_grab_categories())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_CATEGORIES;
		}
		if ($this->can_grab_tags())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_TAGS;
		}
		if ($this->can_grab_models())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_MODELS;
		}
		if ($this->can_grab_content_source())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_CONTENT_SOURCE;
		}
		if ($this->can_grab_rating())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_RATING;
		}
		if ($this->can_grab_views())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_VIEWS;
		}
		if ($this->can_grab_date())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_DATE;
		}
		if ($this->can_grab_custom())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_CUSTOM;
		}
		if ($this->can_grab_user())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_USER;
		}
		if ($this->can_grab_comments())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_COMMENTS;
		}
		return $result;
	}

	/**
	 * Locates content pages in the given list.
	 *
	 * @param string $list_url
	 * @param int $limit
	 *
	 * @return KvsGrabberListResult
	 */
	public function grab_list($list_url, $limit)
	{
		$result = new KvsGrabberListResult();

		if (!$this->can_grab_lists())
		{
			return $result;
		}

		$processed_urls = [];
		$this->grab_list_impl($list_url, $limit, $result, $processed_urls, 1);

		return $result;
	}

	/**
	 * Checks for deleted content and returns list of deleted URLs. If URL starts with ~, KVS would use LIKE search
	 * instead of hash search.
	 *
	 * @return string[]
	 */
	public function get_deleted_urls()
	{
		return [];
	}

	/**
	 * Provides ability to customize post-processing logic in grabbers. Will be executed after each object creation
	 * with object ID and original URL provided.
	 *
	 * @param int $object_id
	 * @param string $object_url
	 */
	public function post_process_inserted_object($object_id, $object_url)
	{
	}

	/**
	 * Returns regexp pattern for content page.
	 *
	 * @return string
	 */
	protected function get_content_page_url_finder_pattern()
	{
		return null;
	}

	/**
	 * Returns code fragment or the whole HTML for searching for content pages.
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	protected function get_content_page_url_finder_html($html)
	{
		return $html;
	}

	/**
	 * Returns regexp patterns for finding pagination from the given list.
	 *
	 * @return array
	 */
	protected function get_pagination_url_finder_patterns()
	{
		return [];
	}

	/**
	 * Returns regexp patterns for finding pagination from the given list.
	 *
	 * @return array
	 */
	protected function get_pagination_url_finder_selectors()
	{
		return [];
	}

	/**
	 * Returns pagination URLs for the given list URL.
	 *
	 * @param string $list_url
	 * @param string $page_html
	 *
	 * @return array
	 */
	protected function get_pagination_urls($list_url, $page_html)
	{
		return [];
	}

	/**
	 * Applies text replacements configured by grabber.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	protected function apply_replacements($string)
	{
		if ($this->settings && $string)
		{
			$replacements = explode("\n", $this->settings->get_replacements());
			foreach ($replacements as $replacement)
			{
				$replacement = trim($replacement);
				if ($replacement != '')
				{
					$replacement = explode(':', $replacement, 2);
					if (count($replacement) == 2)
					{
						$string = str_replace(trim($replacement[0]), trim($replacement[1]), $string);
					}
				}
			}
		}
		return $string;
	}

	/**
	 * Waits timeout to prevent sending many requests.
	 */
	protected function wait_timeout()
	{
		if ($this->settings)
		{
			sleep($this->settings->get_timeout());
		}
	}

	/**
	 * Parses string and returns number from it.
	 *
	 * @param string $string
	 *
	 * @return int
	 */
	protected function parse_number($string)
	{
		$string = str_replace(array(' ', ',', '.'), '', $string);
		return intval($string);
	}

	/**
	 * Parses duration string and returns number from it.
	 *
	 * @param string $string
	 *
	 * @return int
	 */
	protected function parse_duration($string)
	{
		$string = trim($string);
		if (!$string)
		{
			return 0;
		}
		if (strpos($string, 'PT') === 0)
		{
			$string = substr($string, 2);
		}

		$regex1 = "|^([0-9]+)h([0-9]+)m([0-9]+)s$|is";
		$regex2 = "|^([0-9]+)m([0-9]+)s$|is";
		if (preg_match($regex1, $string, $temp))
		{
			return intval($temp[1]) * 3600 + intval($temp[2]) * 60 + intval($temp[3]);
		} elseif (preg_match($regex2, $string, $temp))
		{
			return intval($temp[1]) * 60 + intval($temp[2]);
		} elseif (strpos($string, ':') !== false)
		{
			$temp = explode(':', $string);
			if (count($temp) == 3)
			{
				return intval($temp[0]) * 3600 + intval($temp[1]) * 60 + intval($temp[2]);
			} else
			{
				return intval($temp[0]) * 60 + intval($temp[1]);
			}
		} else
		{
			return intval($string);
		}
	}

	/**
	 * Parses date string and returns date from it.
	 *
	 * @param string $string
	 *
	 * @return int
	 */
	protected function parse_date($string)
	{
		$array = explode(' ', $string, 2);
		if (count($array) == 2 && intval($array[0]) > 0)
		{
			$number = intval($array[0]);
			if (strpos($array[1], 'min') !== false)
			{
				$number *= 60;
			} elseif (strpos($array[1], 'hour') !== false)
			{
				$number *= 3600;
			} elseif (strpos($array[1], 'day') !== false)
			{
				$number *= 3600 * 24;
			} elseif (strpos($array[1], 'week') !== false)
			{
				$number *= 3600 * 24 * 7;
			} elseif (strpos($array[1], 'mon') !== false)
			{
				$number *= 3600 * 24 * 30;
			} elseif (strpos($array[1], 'year') !== false)
			{
				$number *= 3600 * 24 * 365;
			}
			return time() - $number;
		}
		return 0;
	}

	/**
	 * Returns value from meta tag of the given name.
	 *
	 * @param string $tag_name
	 * @param string $html
	 *
	 * @return string
	 */
	protected function find_metatag_value($tag_name, $html)
	{
		if (preg_match("/<\s*meta\s*property\s*=\s*['\"]?{$tag_name}['\"]?\s+content\s*=\s*['\"]?([^>]*)['\"]/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*meta\s*content\s*=\s*['\"]?([^>]*)['\"]\s+property\s*=\s*['\"]?{$tag_name}['\"]?/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*meta\s*name\s*=\s*['\"]?{$tag_name}['\"]?\s+content\s*=\s*['\"]?([^>]*)['\"]/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*meta\s*content\s*=\s*['\"]?([^>]*)['\"]\s+name\s*=\s*['\"]?{$tag_name}['\"]?/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*meta\s*itemprop\s*=\s*['\"]?{$tag_name}['\"]?\s+content\s*=\s*['\"]?([^>]*)['\"]/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*meta\s*content\s*=\s*['\"]?([^>]*)['\"]\s+itemprop\s*=\s*['\"]?{$tag_name}['\"]?/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		return '';
	}

	/**
	 * Returns canonical link.
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	protected function find_canonical_value($html)
	{
		if (preg_match("/<\s*link\s*rel\s*=\s*['\"]?canonical['\"]?\s+href\s*=\s*['\"]?([^>]*)['\"]/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*link\s*href\s*=\s*['\"]?([^>]*)['\"]\s+rel\s*=\s*['\"]?canonical['\"]?/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		return '';
	}

	/**
	 * Returns next link.
	 *
	 * @param string $html
	 *
	 * @return string
	 */
	protected function find_next_page_value($html)
	{
		if (preg_match("/<\s*link\s*rel\s*=\s*['\"]?next['\"]?\s+href\s*=\s*['\"]?([^>]*)['\"]/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		if (preg_match("/<\s*link\s*href\s*=\s*['\"]?([^>]*)['\"]\s+rel\s*=\s*['\"]?next['\"]?/i", $html, $temp))
		{
			return htmlspecialchars_decode($temp[1]);
		}
		return '';
	}

	/**
	 * Queries tag content using the given CSS selector (only ID, classname and tag name options are supported).
	 *
	 * @param string $expression
	 * @param string $html
	 * @param string $attribute
	 * @param string $regexp
	 *
	 * @return string
	 */
	protected function css_query_single($expression, $html, $attribute = null, $regexp = null)
	{
		$result = $this->css_query_list($expression, $html, $attribute);
		if (count($result) > 0)
		{
			$value = $result[0];
			if ($regexp)
			{
				if (preg_match($regexp, $value, $temp))
				{
					return trim($temp[1]);
				}
			} else
			{
				return $value;
			}
		}
		return '';
	}

	/**
	 * Queries tag value list using the given CSS selector (only ID, classname and tag name options are supported).
	 *
	 * @param string $expression
	 * @param string $html
	 * @param string $attribute
	 * @param string $regexp
	 * @param DOMNode $relative_to
	 *
	 * @return string[]
	 */
	protected function css_query_list($expression, $html, $attribute = null, $regexp = null, DOMNode $relative_to = null)
	{
		$result = [];

		if (!$expression)
		{
			return $result;
		}
		if (!$relative_to)
		{
			$dom = new DOMDocument('1.0', 'UTF-8');
			@$dom->loadHTML('<meta http-equiv="content-type" content="text/html; charset=utf-8">' . $html);
			$relative_to = $dom;
		}

		$separator_index = strpos($expression, ' ');
		$further_expression = null;
		$current_expression = null;

		if ($separator_index === 0 || $separator_index == strlen($expression))
		{
			return $result;
		} elseif ($separator_index === false)
		{
			$current_expression = $expression;
		} else
		{
			$current_expression = trim(substr($expression, 0, $separator_index));
			$further_expression = trim(substr($expression, $separator_index + 1));
		}
		if (!$current_expression)
		{
			return $result;
		}

		$pound_index = strpos($current_expression, '#');
		$dot_index = strpos($current_expression, '.');
		$attr_index1 = strpos($current_expression, '[');
		$attr_index2 = strpos($current_expression, ']');

		$id = null;
		$tag_name = null;
		$class_name = null;
		$attr_name_value = null;
		if ($pound_index === strlen($current_expression) - 1)
		{
			return $result;
		} else if ($pound_index === 0)
		{
			$id = substr($current_expression, $pound_index + 1);
		} else if ($pound_index > 0)
		{
			$tag_name = substr($current_expression, 0, $pound_index);
			$id = substr($current_expression, $pound_index + 1);
		} else
		{
			if ($dot_index === strlen($current_expression) - 1)
			{
				return $result;
			} else if ($dot_index === 0)
			{
				$class_name = substr($current_expression, $dot_index + 1);
			} else if ($dot_index > 0)
			{
				$tag_name = substr($current_expression, 0, $dot_index);
				$class_name = substr($current_expression, $dot_index + 1);
			} else
			{
				$tag_name = $current_expression;
			}
		}

		if ($attr_index1 !== false || $attr_index2 !== false)
		{
			if ($attr_index1 === false || $attr_index2 === false || $attr_index1 > $attr_index2)
			{
				return $result;
			} elseif ($attr_index1 === 0)
			{
				$attr_name_value = trim($current_expression, '[]');
			} else
			{
				$tag_name = substr($current_expression, 0, $attr_index1);
				$attr_name_value = trim(substr($current_expression, $attr_index1), '[]');
			}
		}

		if (!$tag_name)
		{
			$tag_name = '*';
		}

		$nodes = $relative_to->getElementsByTagName(strtolower($tag_name));
		for ($i = 0; $i < $nodes->length; $i++)
		{
			$element = $nodes->item($i);

			$id_attr = $element->attributes->getNamedItem('id');
			if ($id && $id_attr && $id_attr->nodeValue == $id)
			{
				if ($further_expression)
				{
					return $this->css_query_list($further_expression, $html, $attribute, $regexp, $element);
				} else
				{
					$value = '';
					if ($attribute)
					{
						if ($attribute == '=HTML')
						{
							$value = $this->inner_html($element);
						} else
						{
							$attribute_node = $element->attributes->getNamedItem($attribute);
							if ($attribute_node)
							{
								$value = $attribute_node->textContent;
							}
						}
					} else
					{
						$value = $element->textContent;
					}
					if ($regexp)
					{
						if (preg_match($regexp, $value, $temp))
						{
							$result[] = trim($temp[1]);
						}
					} else
					{
						$result[] = trim($value);
					}
					return $result;
				}
			}

			$class_attr = $element->attributes->getNamedItem('class');
			if ($class_attr)
			{
				$class_names = array_map('trim', explode(' ', $class_attr->nodeValue));
			}
			if ($class_name && $class_attr && isset($class_names) && in_array($class_name, $class_names))
			{
				if ($further_expression)
				{
					$sub_result = $this->css_query_list($further_expression, $html, $attribute, $regexp, $element);
					foreach ($sub_result as $sub_result_item)
					{
						$result[] = $sub_result_item;
					}
				} else
				{
					$value = '';
					if ($attribute)
					{
						if ($attribute == '=HTML')
						{
							$value = $this->inner_html($element);
						} else
						{
							$attribute_node = $element->attributes->getNamedItem($attribute);
							if ($attribute_node)
							{
								$value = $attribute_node->textContent;
							}
						}
					} else
					{
						$value = $element->textContent;
					}
					if ($regexp)
					{
						if (preg_match($regexp, $value, $temp))
						{
							$result[] = trim($temp[1]);
						}
					} else
					{
						$result[] = trim($value);
					}
				}
			}

			if ($attr_name_value)
			{
				$attr_name_value_temp = explode('=', $attr_name_value, 2);
				if (count($attr_name_value_temp) == 2)
				{
					$attr_name = trim($attr_name_value_temp[0]);
					$attr_value = trim($attr_name_value_temp[1], " \"'");
					$operation = 0;
					if (strpos($attr_name, '!~') !== false)
					{
						$operation = 2;
						$attr_name = trim($attr_name, '!~');
					} elseif (strpos($attr_name, '~') !== false)
					{
						$operation = 1;
						$attr_name = trim($attr_name, '~');
					}
					if ($attr_name)
					{
						$attr = $element->attributes->getNamedItem($attr_name);
						if ($attr && (($operation == 0 && $attr->textContent == $attr_value) || ($operation == 1 && strpos($attr->textContent, $attr_value) !== false) || ($operation == 2 && strpos($attr->textContent, $attr_value) === false)))
						{
							if ($further_expression)
							{
								$sub_result = $this->css_query_list($further_expression, $html, $attribute, $regexp, $element);
								foreach ($sub_result as $sub_result_item)
								{
									$result[] = $sub_result_item;
								}
							} else
							{
								$value = '';
								if ($attribute)
								{
									if ($attribute == '=HTML')
									{
										$value = $this->inner_html($element);
									} else
									{
										$attribute_node = $element->attributes->getNamedItem($attribute);
										if ($attribute_node)
										{
											$value = $attribute_node->textContent;
										}
									}
								} else
								{
									$value = $element->textContent;
								}
								if ($regexp)
								{
									if (preg_match($regexp, $value, $temp))
									{
										$result[] = trim($temp[1]);
									}
								} else
								{
									$result[] = trim($value);
								}
							}
						}
					}
				}
			}

			if (!$id && !$class_name && !$attr_name_value && $tag_name)
			{
				if ($further_expression)
				{
					$sub_result = $this->css_query_list($further_expression, $html, $attribute, $regexp, $element);
					foreach ($sub_result as $sub_result_item)
					{
						$result[] = $sub_result_item;
					}
				} else
				{
					$value = '';
					if ($attribute)
					{
						if ($attribute == '=HTML')
						{
							$value = $this->inner_html($element);
						} else
						{
							$attribute_node = $element->attributes->getNamedItem($attribute);
							if ($attribute_node)
							{
								$value = $attribute_node->textContent;
							}
						}
					} else
					{
						$value = $element->textContent;
					}
					if ($regexp)
					{
						if (preg_match($regexp, $value, $temp))
						{
							$result[] = trim($temp[1]);
						}
					} else
					{
						$result[] = trim($value);
					}
				}
			}
		}

		return $result;
	}

	/**
	 * Loads page content and returns HTML code or null if nothing was loaded or HTTP error occured.
	 *
	 * @param string $page_url
	 * @param string $referer
	 * @param string $cookie_file_path
	 *
	 * @return string|null
	 */
	protected function load_page($page_url, $referer = null, $cookie_file_path = null)
	{
		if ($this->debug)
		{
			echo "Loading URL: $page_url\n";
		}
		$page_url = str_replace(' ', '%20', $page_url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.80 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3',
				'Accept-Language: en-US,en;q=0.8',
		));
		curl_setopt($ch, CURLOPT_URL, $page_url);
		curl_setopt($ch, CURLOPT_POST, 0);

		if ($this->proxy)
		{
			curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}

		if ($cookie_file_path != '')
		{
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		}
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		if ($referer)
		{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		$pageOut = curl_exec($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($http_code != 200)
		{
			return null;
		}

		return $pageOut;
	}

	/**
	 * Checks URL content type.
	 *
	 * @param string $page_url
	 * @param string $referer
	 * @param string $cookie_file_path
	 *
	 * @return string
	 */
	protected function check_content_type($page_url, $referer = null, $cookie_file_path = null)
	{
		$page_url = str_replace(' ', '%20', $page_url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.80 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3',
				'Accept-Language: en-US,en;q=0.8',
		));
		curl_setopt($ch, CURLOPT_URL, $page_url);
		curl_setopt($ch, CURLOPT_POST, 0);

		if ($this->proxy)
		{
			curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}

		if ($cookie_file_path != '')
		{
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		}
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		if ($referer)
		{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 1);

		curl_exec($ch);

		return curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	}

	/**
	 * Detects if the given URL redirects to another.
	 *
	 * @param string $page_url
	 *
	 * @return string
	 */
	protected function detect_redirect($page_url)
	{
		$page_url = str_replace(' ', '%20', $page_url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.80 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.3',
				'Accept-Language: en-US,en;q=0.8',
		));

		if ($this->proxy)
		{
			curl_setopt($ch, CURLOPT_PROXY, $this->proxy);
		}

		for ($i = 0; $i < 5; $i++)
		{
			curl_setopt($ch, CURLOPT_URL, $page_url);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

			$page_out = curl_exec($ch);

			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if ($http_code == 302 || $http_code == 301)
			{
				$page_out = array_map('trim', explode("\n", $page_out));
				foreach ($page_out as $header)
				{
					if (strpos($header, 'Location: ') === 0)
					{
						$page_url = substr($header, 10);
					}
				}
			} else
			{
				break;
			}
		}

		curl_close($ch);
		return $page_url;
	}

	private function inner_html(DOMElement $element)
	{
		$doc = $element->ownerDocument;
		$html = '';

		foreach ($element->childNodes as $node)
		{
			$html .= $doc->saveHTML($node);
		}

		return $html;
	}

	private function grab_list_impl($list_url, $limit, KvsGrabberListResult $result, &$processed_urls, $iteration)
	{
		if (isset($processed_urls[md5($list_url)]))
		{
			return;
		}
		if ($iteration > 10 && count($result->get_content_pages()) == 0)
		{
			return;
		}
		$processed_urls[md5($list_url)] = $list_url;

		$this->wait_timeout();

		$page_code = $this->load_page($list_url);
		if (!$page_code)
		{
			$result->log_error(KvsGrabberListResult::ERROR_CODE_PAGE_UNAVAILABLE, "Page can't be loaded: $list_url");
			return;
		}

		$base_url = parse_url($list_url, PHP_URL_SCHEME) . '://' . parse_url($list_url, PHP_URL_HOST);

		$content_url_finder_pattern = $this->get_content_page_url_finder_pattern();
		if (!$content_url_finder_pattern)
		{
			if (strpos($page_code, '<?xml') !== false)
			{
				$content_url_finder_pattern = "|<link[^>]*>([^<>]*)<|i";
			}
		}

		if (!$content_url_finder_pattern)
		{
			$result->log_error(KvsGrabberListResult::ERROR_CODE_UNEXPECTED_ERROR, "Grabber supports RSS only, the given URL is not RSS format: $list_url");
			return;
		}

		$search_in_code = $this->get_content_page_url_finder_html($page_code);
		if (!$search_in_code)
		{
			$search_in_code = $page_code;
		}

		preg_match_all($content_url_finder_pattern, $search_in_code, $temp);
		foreach ($temp[1] as $content_page)
		{
			if (count($result->get_content_pages()) == $limit && $limit != 0)
			{
				break;
			}
			if (strpos($content_page, '//') === 0)
			{
				$content_page = parse_url($list_url, PHP_URL_SCHEME) . ":$content_page";
			} elseif (strpos($content_page, '/') === 0)
			{
				$content_page = $base_url . $content_page;
			}
			$result->add_content_page($content_page);
		}

		if (count($result->get_content_pages()) == 0 && strpos(trim($page_code), '<?xml') === 0)
		{
			preg_match_all("|<link[^>]*>([^<>]*)<|i", $page_code, $temp);
			foreach ($temp[1] as $content_page)
			{
				if (count($result->get_content_pages()) == $limit && $limit != 0)
				{
					break;
				}
				if (strpos($content_page, '//') === 0)
				{
					$content_page = parse_url($list_url, PHP_URL_SCHEME) . ":$content_page";
				} elseif (strpos($content_page, '/') === 0)
				{
					$content_page = $base_url . $content_page;
				}
				$result->add_content_page($content_page);
			}
		}

		if ($limit > 0)
		{
			$process_callback = $this->progress_callback;
			if (isset($process_callback) && is_callable($process_callback))
			{
				$process_callback(count($result->get_content_pages()));
			}
		}

		if (count($result->get_content_pages()) < $limit)
		{
			$found_next_page = false;

			if (!$found_next_page)
			{
				$pagination_page = $this->find_next_page_value($page_code);
				if ($pagination_page)
				{
					if (strpos($pagination_page, '//') === 0)
					{
						$pagination_page = parse_url($list_url, PHP_URL_SCHEME) . ':' . str_replace('&amp;', '&', $pagination_page);
					} elseif (strpos($pagination_page, '/') === 0)
					{
						$pagination_page = $base_url . str_replace('&amp;', '&', $pagination_page);
					} else
					{
						$pagination_page = str_replace('&amp;', '&', $pagination_page);
					}
					if (!isset($processed_urls[md5($pagination_page)]))
					{
						$found_next_page = true;
						$this->grab_list_impl($pagination_page, $limit, $result, $processed_urls, $iteration + 1);
					}
				}
			}

			$pagination_patterns = $this->get_pagination_url_finder_patterns();
			if (!$found_next_page && $pagination_patterns && is_array($pagination_patterns))
			{
				foreach ($pagination_patterns as $pagination_pattern)
				{
					unset($temp);
					preg_match_all($pagination_pattern, $page_code, $temp);
					foreach ($temp[1] as $pagination_page)
					{
						if (strpos($pagination_page, '//') === 0)
						{
							$pagination_page = parse_url($list_url, PHP_URL_SCHEME) . ':' . str_replace('&amp;', '&', $pagination_page);
						} elseif (strpos($pagination_page, '/') === 0)
						{
							$pagination_page = $base_url . str_replace('&amp;', '&', $pagination_page);
						} else
						{
							$pagination_page = str_replace('&amp;', '&', $pagination_page);
						}
						if (!isset($processed_urls[md5($pagination_page)]))
						{
							$found_next_page = true;
							$this->grab_list_impl($pagination_page, $limit, $result, $processed_urls, $iteration + 1);
							break 2;
						}
					}
				}
			}

			$pagination_selectors = $this->get_pagination_url_finder_selectors();
			if (!$found_next_page && $pagination_selectors && is_array($pagination_selectors))
			{
				foreach ($pagination_selectors as $pagination_selector)
				{
					$temp = $this->css_query_list($pagination_selector, $page_code, 'href');
					foreach ($temp as $pagination_page)
					{
						$pagination_page = trim($pagination_page);
						if ($pagination_page)
						{
							if (strpos($pagination_page, '//') === 0)
							{
								$pagination_page = parse_url($list_url, PHP_URL_SCHEME) . ':' . str_replace('&amp;', '&', $pagination_page);
							} elseif (strpos($pagination_page, '/') === 0)
							{
								$pagination_page = $base_url . str_replace('&amp;', '&', $pagination_page);
							} elseif (strpos($pagination_page, '://') === false)
							{
								$pagination_page = substr($list_url, 0, strrpos($list_url, '/') + 1) . str_replace('&amp;', '&', $pagination_page);
							} else
							{
								$pagination_page = str_replace('&amp;', '&', $pagination_page);
							}
							if (!isset($processed_urls[md5($pagination_page)]))
							{
								$found_next_page = true;
								$this->grab_list_impl($pagination_page, $limit, $result, $processed_urls, $iteration + 1);
								break 2;
							}
						}
					}
				}
			}

			if (!$found_next_page)
			{
				$pagination_urls = $this->get_pagination_urls($list_url, $page_code);
				if ($pagination_urls && is_array($pagination_urls))
				{
					foreach ($pagination_urls as $pagination_page)
					{
						$pagination_page = trim($pagination_page);
						if ($pagination_page)
						{
							if (strpos($pagination_page, '//') === 0)
							{
								$pagination_page = parse_url($list_url, PHP_URL_SCHEME) . ':' . str_replace('&amp;', '&', $pagination_page);
							} elseif (strpos($pagination_page, '/') === 0)
							{
								$pagination_page = $base_url . str_replace('&amp;', '&', $pagination_page);
							} elseif (strpos($pagination_page, '://') === false)
							{
								$pagination_page = substr($list_url, 0, strrpos($list_url, '/') + 1) . str_replace('&amp;', '&', $pagination_page);
							} else
							{
								$pagination_page = str_replace('&amp;', '&', $pagination_page);
							}
							if (!isset($processed_urls[md5($pagination_page)]))
							{
								$this->grab_list_impl($pagination_page, $limit, $result, $processed_urls, $iteration + 1);
								break;
							}
						}
					}
				}
			}
		}
	}
}

abstract class KvsGrabberVideo extends KvsGrabber
{
	const GRABBER_TYPE_VIDEOS = 'videos';

	/**
	 * Returns grabber type.
	 *
	 * @return string
	 */
	final public function get_grabber_type()
	{
		return self::GRABBER_TYPE_VIDEOS;
	}

	/**
	 * Returns whether this grabber can grab channel for each object.
	 *
	 * @return bool
	 */
	public function can_grab_channel()
	{
		return $this->can_grab_content_source();
	}

	/**
	 * Returns whether this grabber can grab files for each video.
	 *
	 * @return bool
	 */
	public function can_grab_video_files()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab embed code for each video.
	 *
	 * @return bool
	 */
	public function can_grab_video_embed()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab duration for each video.
	 *
	 * @return bool
	 */
	public function can_grab_video_duration()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab screenshot for each video.
	 *
	 * @return bool
	 */
	public function can_grab_video_screenshot()
	{
		return false;
	}

	/**
	 * Returns which type of video format this grabber provides.
	 *
	 * @return string
	 */
	public function get_downloadable_video_format()
	{
		return '';
	}

	/**
	 * Parses URL and returns video data.
	 *
	 * @param string $page_url
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberVideoInfo
	 */
	public function grab_video_data($page_url, $tmp_dir)
	{
		$this->wait_timeout();
		$result = $this->grab_video_data_impl($page_url, $tmp_dir);
		if ($result)
		{
			$result->set_title($this->apply_replacements($result->get_title()));
			$result->set_description($this->apply_replacements($result->get_description()));
			if (!$result->get_canonical())
			{
				$result->set_canonical($page_url);
			}

			if ($this->get_settings()->is_import_categories_as_tags())
			{
				$result->categories_to_tags();
			}
		}
		return $result;
	}

	/**
	 * Returns default grabber settings.
	 *
	 * @return KvsGrabberSettings
	 */
	public function create_default_settings()
	{
		$settings = new KvsGrabberSettings();

		$supported_data = $this->get_supported_data();
		foreach ($supported_data as $field)
		{
			if (!in_array($field, [KvsGrabberSettings::DATA_FIELD_COMMENTS, KvsGrabberSettings::DATA_FIELD_USER]))
			{
				$settings->add_data($field);
			}
		}

		$settings->set_quality_missing(KvsGrabberSettings::QUALITY_MISSING_ERROR);
		$settings->set_timeout(5);

		return $settings;
	}

	/**
	 * Returns whether this grabber can download video files.
	 *
	 * @return bool
	 */
	final public function can_download_video()
	{
		return $this->can_grab_video_files();
	}

	/**
	 * Returns whether this grabber can embed videos.
	 *
	 * @return bool
	 */
	final public function can_embed_video()
	{
		return $this->can_grab_video_screenshot() && $this->can_grab_video_duration() && $this->can_grab_video_embed();
	}

	/**
	 * Returns whether this grabber can create pseudo videos.
	 *
	 * @return bool
	 */
	final public function can_pseudo_video()
	{
		return $this->can_grab_video_screenshot() && $this->can_grab_video_duration();
	}

	/**
	 * Returns list of supported content modes (e.g. download, embed or pseudo).
	 *
	 * @return array
	 */
	final public function get_supported_modes()
	{
		$result = parent::get_supported_modes();
		if ($this->can_download_video())
		{
			$result[] = KvsGrabberSettings::GRAB_MODE_DOWNLOAD;
		}
		if ($this->can_embed_video())
		{
			$result[] = KvsGrabberSettings::GRAB_MODE_EMBED;
		}
		if ($this->can_pseudo_video())
		{
			$result[] = KvsGrabberSettings::GRAB_MODE_PSEUDO;
		}
		return $result;
	}

	/**
	 * Returns list of supported fields.
	 *
	 * @return array
	 */
	final public function get_supported_data()
	{
		$result = parent::get_supported_data();
		if ($this->can_grab_channel())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_CHANNEL;
		}
		if ($this->can_grab_video_screenshot())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_SCREENSHOT;
		}
		return $result;
	}

	/**
	 * Parses URL and returns video data.
	 *
	 * @param string $page_url
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberVideoInfo
	 */
	abstract protected function grab_video_data_impl($page_url, $tmp_dir);
}

abstract class KvsGrabberAlbum extends KvsGrabber
{
	const GRABBER_TYPE_ALBUMS = 'albums';

	/**
	 * Returns grabber type.
	 *
	 * @return string
	 */
	final public function get_grabber_type()
	{
		return self::GRABBER_TYPE_ALBUMS;
	}

	/**
	 * Parses URL and returns album data.
	 *
	 * @param string $page_url
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberAlbumInfo
	 */
	public function grab_album_data($page_url, $tmp_dir)
	{
		$this->wait_timeout();
		$result = $this->grab_album_data_impl($page_url, $tmp_dir);
		if ($result)
		{
			$result->set_title($this->apply_replacements($result->get_title()));
			$result->set_description($this->apply_replacements($result->get_description()));
			if (!$result->get_canonical())
			{
				$result->set_canonical($page_url);
			}

			if ($this->get_settings()->is_import_categories_as_tags())
			{
				$result->categories_to_tags();
			}
		}
		return $result;
	}

	/**
	 * Returns default grabber settings.
	 *
	 * @return KvsGrabberSettings
	 */
	public function create_default_settings()
	{
		$settings = new KvsGrabberSettings();
		$settings->set_mode(KvsGrabberSettings::GRAB_MODE_DOWNLOAD);

		$supported_data = $this->get_supported_data();
		foreach ($supported_data as $field)
		{
			if (!in_array($field, [KvsGrabberSettings::DATA_FIELD_COMMENTS, KvsGrabberSettings::DATA_FIELD_USER]))
			{
				$settings->add_data($field);
			}
		}

		$settings->set_quality_missing(KvsGrabberSettings::QUALITY_MISSING_ERROR);
		$settings->set_timeout(5);

		return $settings;
	}

	/**
	 * Returns list of supported content modes (e.g. download, embed or pseudo).
	 *
	 * @return array
	 */
	final public function get_supported_modes()
	{
		$result = parent::get_supported_modes();
		$result[] = KvsGrabberSettings::GRAB_MODE_DOWNLOAD;
		return $result;
	}

	/**
	 * Returns list of supported fields.
	 *
	 * @return array
	 */
	final public function get_supported_data()
	{
		return parent::get_supported_data();
	}

	/**
	 * Parses URL and returns album data.
	 *
	 * @param string $page_url
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberAlbumInfo
	 */
	abstract protected function grab_album_data_impl($page_url, $tmp_dir);
}

abstract class KvsGrabberModel extends KvsGrabber
{
	const GRABBER_TYPE_MODELS = 'models';

	/**
	 * Returns grabber type.
	 *
	 * @return string
	 */
	final public function get_grabber_type()
	{
		return self::GRABBER_TYPE_MODELS;
	}

	/**
	 * Returns if this grabber supports ordering.
	 *
	 * @return bool
	 */
	final public function is_orderable()
	{
		return true;
	}

	/**
	 * Returns whether this grabber can grab age for each model.
	 *
	 * @return bool
	 */
	public function can_grab_age()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab birth date for each model.
	 *
	 * @return bool
	 */
	public function can_grab_birth_date()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab gender for each model.
	 *
	 * @return bool
	 */
	public function can_grab_gender()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab pseudonyms for each model.
	 *
	 * @return bool
	 */
	public function can_grab_pseudonyms()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab height for each model.
	 *
	 * @return bool
	 */
	public function can_grab_height()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab weight for each model.
	 *
	 * @return bool
	 */
	public function can_grab_weight()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab measurements for each model.
	 *
	 * @return bool
	 */
	public function can_grab_measurements()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab country for each model.
	 *
	 * @return bool
	 */
	public function can_grab_country()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab city for each model.
	 *
	 * @return bool
	 */
	public function can_grab_city()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab state for each model.
	 *
	 * @return bool
	 */
	public function can_grab_state()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab eye color for each model.
	 *
	 * @return bool
	 */
	public function can_grab_eye_color()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab hair color for each model.
	 *
	 * @return bool
	 */
	public function can_grab_hair_color()
	{
		return false;
	}

	/**
	 * Returns whether this grabber can grab screenshot for each model.
	 *
	 * @return bool
	 */
	public function can_grab_model_screenshot()
	{
		return false;
	}

	/**
	 * Searches for model with the given title and returns model data.
	 *
	 * @param string $title
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberModelInfo
	 */
	public function grab_model_data($title, $tmp_dir)
	{
		$this->wait_timeout();
		$result = $this->grab_model_data_impl($title, $tmp_dir);
		if ($result)
		{
			$result->set_description($this->apply_replacements($result->get_description()));
		}
		return $result;
	}

	/**
	 * Returns default grabber settings.
	 *
	 * @return KvsGrabberSettings
	 */
	public function create_default_settings()
	{
		$settings = new KvsGrabberSettings();
		$settings->set_mode(KvsGrabberSettings::GRAB_MODE_DOWNLOAD);

		$supported_data = $this->get_supported_data();
		foreach ($supported_data as $field)
		{
			$settings->add_data($field);
		}

		$settings->set_quality_missing(KvsGrabberSettings::QUALITY_MISSING_ERROR);
		$settings->set_timeout(5);

		return $settings;
	}

	/**
	 * Returns list of supported content modes (e.g. download, embed or pseudo).
	 *
	 * @return array
	 */
	final public function get_supported_modes()
	{
		$result = parent::get_supported_modes();
		$result[] = KvsGrabberSettings::GRAB_MODE_DOWNLOAD;
		return $result;
	}

	/**
	 * Returns list of supported fields.
	 *
	 * @return array
	 */
	final public function get_supported_data()
	{
		$result = parent::get_supported_data();
		if ($this->can_grab_age())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_AGE;
		}
		if ($this->can_grab_birth_date())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_BIRTH_DATE;
		}
		if ($this->can_grab_gender())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_GENDER;
		}
		if ($this->can_grab_pseudonyms())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_PSEUDOMYNS;
		}
		if ($this->can_grab_height())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_HEIGHT;
		}
		if ($this->can_grab_weight())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_WEIGHT;
		}
		if ($this->can_grab_measurements())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_MEASUREMENTS;
		}
		if ($this->can_grab_country())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_COUNTRY;
		}
		if ($this->can_grab_city())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_CITY;
		}
		if ($this->can_grab_state())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_STATE;
		}
		if ($this->can_grab_eye_color())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_EYE_COLOR;
		}
		if ($this->can_grab_hair_color())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_HAIR_COLOR;
		}
		if ($this->can_grab_model_screenshot())
		{
			$result[] = KvsGrabberSettings::DATA_FIELD_SCREENSHOT;
		}
		return $result;
	}

	/**
	 * Searches for model with the given title and returns model data.
	 *
	 * @param string $title
	 * @param string $tmp_dir
	 *
	 * @return KvsGrabberModelInfo
	 */
	abstract protected function grab_model_data_impl($title, $tmp_dir);
}

abstract class KvsGrabberVideoYDL extends KvsGrabberVideo
{
	/**
	 * @var string
	 */
	private $ydl_binary;

	/**
	 * @param string $ydl_binary
	 */
	public function set_ydl_binary($ydl_binary)
	{
		$this->ydl_binary = trim($ydl_binary);
	}

	/**
	 * @return string
	 */
	public function get_ydl_binary()
	{
		return $this->ydl_binary;
	}

	/**
	 * @param string $page_url
	 * @param string|array $qualities
	 * @param string $download_dir
	 */
	public function download_files($page_url, $qualities, $download_dir)
	{
		if (!$this->ydl_binary)
		{
			return;
		}

		$download_formats = [];
		$download_filenames = [];
		$download_filename = 'file.tmp';
		if (is_array($qualities) && count($qualities) == 1 && end($qualities) == '?')
		{
			$qualities = '?';
		}
		if (is_array($qualities))
		{
			$download_filename = '%(height)s.tmp';

			foreach ($qualities as $quality)
			{
				$quality = intval($quality);
				if ($quality > 0)
				{
					if ($this->get_download_format_option($quality))
					{
						$download_formats[] = $this->get_download_format_option($quality);
					} else
					{
						$download_formats[] = "best[height=$quality]";
					}
					$download_filenames[] = str_replace('%(height)s', "$quality", $download_filename);
				}
			}
		} else
		{
			$quality = intval($qualities);
			if ($quality > 0)
			{
				if ($this->get_download_format_option($quality))
				{
					$download_formats[] = $this->get_download_format_option($quality);
				} else
				{
					$quality_range_min = $quality - 15;
					$quality_range_max = $quality + 15;
					$download_formats[] = "best[height>=$quality_range_min][height<=$quality_range_max]";
				}
			} else
			{
				$download_formats[] = 'best';
			}
			$download_filenames[] = 'file.tmp';
		}
		if (count($download_formats) > 0)
		{
			$download_formats = implode(',', $download_formats);

			$ydl_binary = escapeshellcmd($this->ydl_binary);
			$ydl_url = escapeshellarg($page_url);

			$proxy = '';
			if ($this->proxy)
			{
				$proxy = '--socket-timeout 20 --proxy ' . escapeshellarg($this->proxy);
			}

			$account = '';
			if ($this->get_settings()->get_account())
			{
				$account_pair = explode(':', $this->get_settings()->get_account(), 2);
				if (count($account_pair) == 2 && $account_pair[0] && $account_pair[1])
				{
					$account = '--username ' . escapeshellarg($account_pair[0]) . ' --password ' . escapeshellarg($account_pair[1]);
				}
			}

			unset($res);
			exec("$ydl_binary -o '$download_dir/$download_filename' -f '$download_formats' $proxy $account $ydl_url 2>&1", $res);
			$this->log_info(implode("\n", $res));

			$found_merged_files = false;
			foreach ($download_filenames as $download_filename)
			{
				if (is_file("$download_dir/$download_filename.mp4"))
				{
					$found_merged_files = true;
					rename("$download_dir/$download_filename.mp4", "$download_dir/$download_filename");
				}
			}
			if (is_array($qualities) && strpos($download_formats, '[height<=') !== false && !$found_merged_files)
			{
				$required_formats = [];
				foreach ($download_filenames as $download_filename)
				{
					$required_formats[] = intval($download_filename);
				}
				sort($required_formats, SORT_ASC);

				$downloaded_formats = [];
				$dh = opendir($download_dir);
				if ($dh)
				{
					while (($entry = readdir($dh)) !== false)
					{
						if (substr($entry, -8) == '.tmp.mp4')
						{
							$downloaded_formats[] = intval(substr($entry, 0, -8));
						}
					}
					closedir($dh);
				}
				sort($downloaded_formats, SORT_ASC);

				if (count($required_formats) > 0 && count($required_formats) == count($downloaded_formats))
				{
					for ($i = 0; $i < count($downloaded_formats); $i++)
					{
						if (is_file("$download_dir/$downloaded_formats[$i].tmp.mp4"))
						{
							rename("$download_dir/$downloaded_formats[$i].tmp.mp4", "$download_dir/$required_formats[$i].tmp");
						}
					}
				}
			}
			return;
		}
		$this->log_info('No download formats specified');
	}

	protected function get_download_format_option($height)
	{
		return null;
	}

	protected function grab_video_data_impl($page_url, $tmp_dir)
	{
		$result = new KvsGrabberVideoInfo();

		$rnd = mt_rand(1000000000, 9999999999);
		$json_file = "$tmp_dir/grabber-$rnd.json";

		if (!$this->ydl_binary)
		{
			$result->log_error(KvsGrabberVideoInfo::ERROR_CODE_UNEXPECTED_ERROR, 'No youtube-dl binary path is set');
			return $result;
		} elseif (!is_dir($tmp_dir) || !is_writable($tmp_dir))
		{
			$result->log_error(KvsGrabberVideoInfo::ERROR_CODE_UNEXPECTED_ERROR, 'Temporary directory doesn\'t exist or not writable');
			return $result;
		} else
		{
			$ydl_binary = escapeshellcmd($this->ydl_binary);
			$ydl_url = escapeshellarg($page_url);

			$proxy = '';
			if ($this->proxy)
			{
				$proxy = '--socket-timeout 20 --proxy ' . escapeshellarg($this->proxy);
			}

			$account = '';
			if ($this->get_settings()->get_account())
			{
				$account_pair = explode(':', $this->get_settings()->get_account(), 2);
				if (count($account_pair) == 2 && $account_pair[0] && $account_pair[1])
				{
					$account = '--username ' . escapeshellarg($account_pair[0]) . ' --password ' . escapeshellarg($account_pair[1]);
				}
			}

			unset($res);
			exec("$ydl_binary $proxy $account --dump-json $ydl_url 2>&1 > $json_file", $res);
			if (!is_file($json_file) || intval(filesize($json_file)) == 0)
			{
				$this->log_info(implode("\n", $res));
				$result->log_error(KvsGrabberVideoInfo::ERROR_CODE_UNEXPECTED_ERROR, 'Empty response from youtube-dl');
				@unlink($json_file);
				return $result;
			}
		}

		$grabbed_data = file_get_contents($json_file);
		$grabbed_data = json_decode($grabbed_data, true);
		if (!is_array($grabbed_data))
		{
			$result->log_error(KvsGrabberVideoInfo::ERROR_CODE_UNEXPECTED_ERROR, 'Invalid response from youtube-dl');
			@unlink($json_file);
			return $result;
		}

		$result->set_title($grabbed_data['title']);
		$result->set_description($grabbed_data['description']);
		$result->set_canonical($grabbed_data['webpage_url']);
		$result->set_duration($grabbed_data['duration']);
		$result->set_date($grabbed_data['timestamp']);
		$result->set_screenshot($grabbed_data['thumbnail']);
		if (isset($grabbed_data['tags']))
		{
			foreach ($grabbed_data['tags'] as $tag)
			{
				$result->add_tag($tag);
			}
		}
		if (isset($grabbed_data['categories']))
		{
			foreach ($grabbed_data['categories'] as $category)
			{
				$result->add_category($category);
			}
		}
		if (isset($grabbed_data['formats']))
		{
			foreach ($grabbed_data['formats'] as $format)
			{
				if ($this->get_downloadable_video_format() != '')
				{
					if ($format['ext'] == $this->get_downloadable_video_format() && $format['acodec'] != 'none')
					{
						if (in_array("$format[height]p", $this->get_supported_qualities()))
						{
							$result->add_video_file("$format[height]p", $format['url']);
						} else
						{
							foreach ($this->get_supported_qualities() as $quality)
							{
								if (abs(intval($format['height']) - intval($quality)) <= 15)
								{
									$result->add_video_file($quality, $format['url']);
									break;
								}
							}
						}
					}
				} else
				{
					if ($format['acodec'] != 'none')
					{
						if (in_array("$format[height]p", $this->get_supported_qualities()))
						{
							$result->add_video_file("$format[height]p", $format['url']);
						} else
						{
							foreach ($this->get_supported_qualities() as $quality)
							{
								if (abs(intval($format['height']) - intval($quality)) <= 15)
								{
									$result->add_video_file($quality, $format['url']);
									break;
								}
							}
						}
					}
				}
			}
		}

		$result->set_additional_data($grabbed_data);

		@unlink($json_file);
		return $result;
	}
}

class KvsGrabberFactory
{
	private static $grabbers = [];

	/**
	 * @param string $grabber
	 */
	public static function register_grabber_class($grabber)
	{
		foreach (self::$grabbers as $registered_grabber)
		{
			if ($grabber == $registered_grabber)
			{
				return;
			}
		}
		if (class_exists($grabber))
		{
			try
			{
				$grabber_class = new ReflectionClass($grabber);
				if ($grabber_class->isSubclassOf('KvsGrabber'))
				{
					self::$grabbers[] = $grabber;
				}
			} catch (ReflectionException $ignored)
			{
			}
		}
	}

	/**
	 * @return array
	 */
	public static function get_registered_grabber_classes()
	{
		return self::$grabbers;
	}

	/**
	 * @param string $installation_type
	 *
	 * @return array
	 */
	public static function get_supported_grabber_types($installation_type)
	{
		$result = array(KvsGrabberVideo::GRABBER_TYPE_VIDEOS);
		if ($installation_type == 4)
		{
			$result[] = KvsGrabberAlbum::GRABBER_TYPE_ALBUMS;
		}
		return $result;
	}

	/**
	 * @return bool
	 */
	public static function is_grabbers_installed()
	{
		return count(self::$grabbers) > 0;
	}
}