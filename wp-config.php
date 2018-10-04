<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'charm');

/** Username của database */
define('DB_USER', 'root');

/** Mật khẩu của database */
define('DB_PASSWORD', '');

/** Hostname của database */
define('DB_HOST', 'localhost');

/** Database charset sử dụng để tạo bảng database. */
define('DB_CHARSET', 'utf8mb4');

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[9;T~K|Iw[l2kBZto}G1q5r2lwS@x|n{f3?!cOAwZ/R=<X@ Ve~V(`);>u?KRO6T');
define('SECURE_AUTH_KEY',  '}#p/G9ZY~1kz0u`*/uc(iD*V[FWeP]u1:xH:C0:^/o9EGtuNu.[kEODg_z,`<BC3');
define('LOGGED_IN_KEY',    '^g- fcE71H]uy@)](7CnlL*HG5w|s?ZuR`75`$!^_jP+pQ)6J$KIo?qR:@dv3M.T');
define('NONCE_KEY',        'IZnqb,WiJ8J;isJZum8:U:0d>E?a0LFE_ebN+elh}V,tDc~(x8ijX)Ot5eA %fzj');
define('AUTH_SALT',        ';sQ+z[ZtV{^OOZb@$z4}==COs0K8/5~Zi>M~CQ%kO`TEY; SceF}7.O^KOg|3L#-');
define('SECURE_AUTH_SALT', 'tK6KJKA8raFs$O;&ex>o6k`@h&!lvmvMuu5b%v$ohSAUF~NT[C9CpPNYGL:1LJM(');
define('LOGGED_IN_SALT',   'TP(~y8lKeIuD XdtiqOFqXA/=,A&@Cp?8ZnbKxvZ-`*}fY1=Cp[d%pq+uO,Z8caD');
define('NONCE_SALT',       'Bpp>Mu<1`1.tKDP|.AfyMT<NS1{zq@j-S=`&-5J2lWSxHJg! Ribf~U4(*AhQgw,');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
