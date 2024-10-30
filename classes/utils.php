<?phpnamespace MasterElements\Classes;defined( 'ABSPATH' ) || exit;/** * Global helper class. * * @since 1.0.0 */if(!class_exists('\MasterElements\Classes\Utils')):class Utils{	public static function make_classname( $dirname ) {		$dirname = pathinfo($dirname, PATHINFO_FILENAME);		$class_name	 = explode( '-', $dirname );		$class_name	 = array_map( 'ucfirst', $class_name );		$class_name	 = implode( '_', $class_name );		return $class_name;	}    public static function is_empty( $source, $key = false ) {        if ( is_array( $source ) ) {            if ( ! isset( $source[ $key ] ) ) {                return true;            }            $source = $source[ $key ];        }        return '0' !== $source && empty( $source );    }}endif;