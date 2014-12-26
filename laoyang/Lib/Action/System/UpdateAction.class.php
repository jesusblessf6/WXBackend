<?php 
/**
 *网站后台
 *@package ai9.me
 *@author AI9.ME
 **/
class UpdateAction extends BackAction
{
    public function index()
    {
        $version = CONF_PATH . 'version.php';
        $ver = include $version;
        $ver = $ver['ver'];
        $updatehost = 'http://up.ai9.me/update';
        $lastver = file_get_contents(($updatehost . '/update.php?a=check&v=') . $ver);
        if($lastver!==$ver){
           $updateinfo = ('<p class="red">最新版本为：【AI9】 多用户微信营销系统v ' . $lastver) . '</p><span><a href=./index.php?g=System&m=Update&a=updatenow>点击这里在线升级</a></span>';
		   $chanageinfo = file_get_contents(($updatehost . '/update.php?a=chanage&v=') . $lastver);
		}else{
		   $updateinfo = ('<p class="red">最新版本为：【AI9】 多用户微信营销系统v ' . $lastver) . '</p><span>已经是最新系统 不需要升级</span>';
		}

        $this->assign('updateinfo', $updateinfo);
		$this->assign('chanageinfo', $chanageinfo);
        $this->display();
    }
    public function updatenow()
    {
        $version = CONF_PATH . 'version.php';
        $ver = include $version;
        $ver = $ver['ver'];
        $updatehost = 'http://up.ai9.me/update';
        $updatenowinfo = file_get_contents(((($updatehost . '/update.php?a=update&v=') . $ver) . '&u=') . urlencode((('http://' . $_SERVER['HTTP_HOST']) . $_SERVER['PHP_SELF'])));
        if (strstr($updatenowinfo, 'zip')) {
            $pathurl = ($updatehost . '/') . $updatenowinfo;
            get_file($pathurl, CONF_PATH . 'update');
            $z = new Zip();
            $updatezip = ((CONF_PATH . 'update') . '/') . $updatenowinfo;
            $result = $z->Extract($updatezip, './');
			$Model = M();
			@$sql =  file_get_contents(CONF_PATH . 'update'.'/update.sql');
			if($sql){
			   $rs = $Model->execute($sql);
            }
			if ($result == -1) {
                $updatenowinfo = "<font color=red>文件 {$updatezip} 错误.升级失败</font>";
            }else{
                $updatenowinfo = "<font color=red>升级完成,共建立 {$z->total_folders} 个目录,{$z->total_files} 个文件.</font><span><a href=./index.php?g=System&m=Update>点击这里返回系统首页</a></span>";
			}
        }
        $this->assign('updatenowinfo', $updatenowinfo);
        $this->display();
    }
}
class zip
{
    public $total_files = 0;
    public $total_folders = 0;
    public function Extract($zn, $to, $index = array(-1))
    {
        $ok = 0;
        $zip = @fopen($zn, 'rb');
        if (!$zip) {
            return -1;
        }
        $cdir = $this->ReadCentralDir($zip, $zn);
        $pos_entry = $cdir['offset'];
        if (!is_array($index)) {
            $index = array($index);
        }
        for ($i = 0; $index[$i]; $i++) {
            if (intval($index[$i]) != $index[$i] || $index[$i] > $cdir['entries']) {
                return -1;
            }
        }
        for ($i = 0; $i < $cdir['entries']; $i++) {
            @fseek($zip, $pos_entry);
            $header = $this->ReadCentralFileHeaders($zip);
            $header['index'] = $i;
            $pos_entry = ftell($zip);
            @rewind($zip);
            fseek($zip, $header['offset']);
            if (in_array('-1', $index) || in_array($i, $index)) {
                $stat[$header['filename']] = $this->ExtractFile($header, $to, $zip);
            }
        }
        fclose($zip);
        return $stat;
    }
    public function ReadFileHeader($zip)
    {
        $binary_data = fread($zip, 30);
        $data = unpack('vchk/vid/vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len', $binary_data);
        $header['filename'] = fread($zip, $data['filename_len']);
        if ($data['extra_len'] != 0) {
            $header['extra'] = fread($zip, $data['extra_len']);
        } else {
            $header['extra'] = '';
        }
        $header['compression'] = $data['compression'];
        $header['size'] = $data['size'];
        $header['compressed_size'] = $data['compressed_size'];
        $header['crc'] = $data['crc'];
        $header['flag'] = $data['flag'];
        $header['mdate'] = $data['mdate'];
        $header['mtime'] = $data['mtime'];
        if ($header['mdate'] && $header['mtime']) {
            $hour = ($header['mtime'] & 63488) >> 11;
            $minute = ($header['mtime'] & 2016) >> 5;
            $seconde = ($header['mtime'] & 31) * 2;
            $year = (($header['mdate'] & 65024) >> 9) + 1980;
            $month = ($header['mdate'] & 480) >> 5;
            $day = $header['mdate'] & 31;
            $header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
        } else {
            $header['mtime'] = time();
        }
        $header['stored_filename'] = $header['filename'];
        $header['status'] = 'ok';
        return $header;
    }
    public function ReadCentralFileHeaders($zip)
    {
        $binary_data = fread($zip, 46);
        $header = unpack('vchkid/vid/vversion/vversion_extracted/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset', $binary_data);
        if ($header['filename_len'] != 0) {
            $header['filename'] = fread($zip, $header['filename_len']);
        } else {
            $header['filename'] = '';
        }
        if ($header['extra_len'] != 0) {
            $header['extra'] = fread($zip, $header['extra_len']);
        } else {
            $header['extra'] = '';
        }
        if ($header['comment_len'] != 0) {
            $header['comment'] = fread($zip, $header['comment_len']);
        } else {
            $header['comment'] = '';
        }
        if ($header['mdate'] && $header['mtime']) {
            $hour = ($header['mtime'] & 63488) >> 11;
            $minute = ($header['mtime'] & 2016) >> 5;
            $seconde = ($header['mtime'] & 31) * 2;
            $year = (($header['mdate'] & 65024) >> 9) + 1980;
            $month = ($header['mdate'] & 480) >> 5;
            $day = $header['mdate'] & 31;
            $header['mtime'] = mktime($hour, $minute, $seconde, $month, $day, $year);
        } else {
            $header['mtime'] = time();
        }
        $header['stored_filename'] = $header['filename'];
        $header['status'] = 'ok';
        if (substr($header['filename'], -1) == '/') {
            $header['external'] = 1107230736;
        }
        return $header;
    }
    public function ReadCentralDir($zip, $zip_name)
    {
        $size = filesize($zip_name);
        if ($size < 277) {
            $maximum_size = $size;
        } else {
            $maximum_size = 277;
        }
        @fseek($zip, ($size - $maximum_size));
        $pos = ftell($zip);
        $bytes = 0;
        while ($pos < $size) {
            $byte = @fread($zip, 1);
            $bytes = $bytes << 8 | ord($byte);
            if ($bytes == 1347093766 or $bytes == 3346289354728998150) {
                $pos++;
                break;
            }
            $pos++;
        }
        $fdata = fread($zip, 18);
        $data = @unpack('vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcomment_size', $fdata);
        if ($data['comment_size'] != 0) {
            $centd['comment'] = fread($zip, $data['comment_size']);
        } else {
            $centd['comment'] = '';
        }
        $centd['entries'] = $data['entries'];
        $centd['disk_entries'] = $data['disk_entries'];
        $centd['offset'] = $data['offset'];
        $centd['disk_start'] = $data['disk_start'];
        $centd['size'] = $data['size'];
        $centd['disk'] = $data['disk'];
        return $centd;
    }
    public function ExtractFile($header, $to, $zip)
    {
        $header = $this->readfileheader($zip);
        if (substr($to, -1) != '/') {
            $to .= '/';
        }
        if ($to == './') {
            $to = '';
        }
        $pth = explode('/', $to . $header['filename']);
        $mydir = '';
        for ($i = 0; $i < count($pth) - 1; $i++) {
            if (!$pth[$i]) {
                continue;
            }
            $mydir .= $pth[$i] . '/';
            if (!is_dir($mydir) && @mkdir($mydir, 511) || ($mydir == $to . $header['filename'] || $mydir == $to && $this->total_folders == 0) && is_dir($mydir)) {
                @chmod($mydir, 511);
                $this->total_folders++;
            }
        }
        if (strrchr($header['filename'], '/') == '/') {
            return;
        }
        if (!($header['external'] == 1107230736) && !($header['external'] == 16)) {
            if ($header['compression'] == 0) {
                $fp = @fopen(($to . $header['filename']), 'wb');
                if (!$fp) {
                    return -1;
                }
                $size = $header['compressed_size'];
                while ($size != 0) {
                    $read_size = $size < 2048 ? $size : 2048;
                    $buffer = fread($zip, $read_size);
                    $binary_data = pack('a' . $read_size, $buffer);
                    @fwrite($fp, $binary_data, $read_size);
                    $size -= $read_size;
                }
                fclose($fp);
                touch($to . $header['filename'], $header['mtime']);
            } else {
                $fp = @fopen((($to . $header['filename']) . '.gz'), 'wb');
                if (!$fp) {
                    return -1;
                }
                $binary_data = pack('va1a1Va1a1', 35615, Chr($header['compression']), Chr(0), time(), Chr(0), Chr(3));
                fwrite($fp, $binary_data, 10);
                $size = $header['compressed_size'];
                while ($size != 0) {
                    $read_size = $size < 1024 ? $size : 1024;
                    $buffer = fread($zip, $read_size);
                    $binary_data = pack('a' . $read_size, $buffer);
                    @fwrite($fp, $binary_data, $read_size);
                    $size -= $read_size;
                }
                $binary_data = pack('VV', $header['crc'], $header['size']);
                fwrite($fp, $binary_data, 8);
                fclose($fp);
                $gzp = @gzopen((($to . $header['filename']) . '.gz'), 'rb') or die('Cette archive est compress閑');
                if (!$gzp) {
                    return -2;
                }
                $fp = @fopen(($to . $header['filename']), 'wb');
                if (!$fp) {
                    return -1;
                }
                $size = $header['size'];
                while ($size != 0) {
                    $read_size = $size < 2048 ? $size : 2048;
                    $buffer = gzread($gzp, $read_size);
                    $binary_data = pack('a' . $read_size, $buffer);
                    @fwrite($fp, $binary_data, $read_size);
                    $size -= $read_size;
                }
                fclose($fp);
                gzclose($gzp);
                touch($to . $header['filename'], $header['mtime']);
                @unlink((($to . $header['filename']) . '.gz'));
            }
        }
        $this->total_files++;
        return true;
    }
}
function get_file($url, $folder = './')
{
    set_time_limit((24 * 60) * 60);
    // 设置超时时间
    $destination_folder = $folder . '/';
    // 文件下载保存目录，默认为当前文件目录
    if (!is_dir($destination_folder)) {
        // 判断目录是否存在
        mkdirs($destination_folder);
    }
    $newfname = $destination_folder . basename($url);
    // 取得文件的名称
    $file = fopen($url, 'rb');
    // 远程下载文件，二进制模式
    if ($file) {
        // 如果下载成功
        $newf = fopen($newfname, 'wb');
        // 远在文件文件
        if ($newf) {
            // 如果文件保存成功
            while (!feof($file)) {
                // 判断附件写入是否完整
                fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
            }
        }
    }
    if ($file) {
        fclose($file);
    }
    if ($newf) {
        fclose($newf);
    }
    return true;
}
function mkdirs($path, $mode = '0755')
{
    if (!is_dir($path)) {
        // 判断目录是否存在
        mkdirs(dirname($path), $mode);
        // 循环建立目录
        mkdir($path, $mode);
    }
    return true;
}