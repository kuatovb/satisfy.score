<?php

namespace library;

class File extends Input{

    private static $newFile;

    /**
     * Выполняет загрузку файла в серсвер
     * 
     * var_dump(File::upload('userfile', 'uploads/'));
     *
     * @param string $uploaddir
     * @param string $inputName
     * @return void
     */
    public static function upload($inputName, $uploaddir = '')
    {
        if ( isset($uploaddir) && isset($inputName) ) {
			$file_tmp = self::get($inputName)['tmp_name'];
            $file_name = self::get($inputName)['name'];
            $file_ext = strtolower(end(explode('.', self::get($inputName)['name'])));
            

			if ( move_uploaded_file($file_tmp, $uploaddir . $file_name ) ) {

                $newFileName = Hash::unique() . '.' .  $file_ext;

                if (rename($uploaddir . $file_name, $uploaddir .$newFileName )) {
                    self::$newFile = $newFileName;
                }


				return true;
			}
			return false;
        }else {
            echo 'Вы не ввели директорию для загрузки файла!';
        }

    }

    /**
     * возвращает новое назвние файла
     *
     * @return void
     */
    public static function getNewFileName()
    {
        return self::$newFile;
    }
}