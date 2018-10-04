<?php
if( !class_exists( 'TLPTeamHelper' ) ) :

	class TLPTeamHelper {
		function verifyNonce(){
			$nonce     = isset( $_REQUEST[ $this->nonceId() ] ) ? $_REQUEST[ $this->nonceId() ] : null;
			$nonceText = $this->nonceText();
			if ( ! wp_verify_nonce( $nonce, $nonceText ) ) {
				return false;
			}
			return true;
		}

        function nonceText(){
        	return "tlp_team_nonce";
        }
		function nonceId() {
			return "tlp_nonce";
		}
	}
endif;
