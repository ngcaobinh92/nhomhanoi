<?php
class elFinderVolumeMyLocalFileSystem extends elFinderVolumeLocalFileSystem
{
	protected function tmbname($stat) {
		$dir = $this->relpathCE($this->decode($stat['phash']));
		if (! is_dir($this->tmbPath.DIRECTORY_SEPARATOR.$dir)) {
			$dirs = explode(DIRECTORY_SEPARATOR, $dir);
			$target = $this->tmbPath;
			foreach($dirs as $_dir) {
				if (! is_dir($target . DIRECTORY_SEPARATOR . $_dir)) {
					mkdir($target . DIRECTORY_SEPARATOR . $_dir);
				}
				$target = $target . DIRECTORY_SEPARATOR . $_dir;
			}
		}
		console.log($dir . DIRECTORY_SEPARATOR . $stat['name'] . '.png');
		return $dir . DIRECTORY_SEPARATOR . $stat['name'] . '.png';
	}

	protected function gettmb($path, $stat) {
		if ($name = parent::gettmb($path, $stat)) {
			$name = str_replace('\\', '/', $name); // For windows server
			$name = str_replace('%2F', '/', rawurlencode($name));
		}
		return $name;
	}

	public function tmb($hash) {
		if ($name = parent::tmb($hash)) {
			$name = str_replace('\\', '/', $name); // For windows server
			$name = str_replace('%2F', '/', rawurlencode($name));
		}
		return $name;
	}
}