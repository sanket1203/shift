<?php
/**
 * Media Model
 *
 * PHP Version 5.6
 *
 * Media file contains the Media Model
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Media class - operates the media table.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Media extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'media';

    /**
     * Initialise the model
     */
    public function __construct() {
        
        // Call the Model constructor
        parent::__construct();
        
        // Set the tables value
        $this->tables = $this->config->item('tables', $this->table);
    }
    
    /**
     * The public method save_media saves user's media
     *
     * @param integer $user_id contains the user_id
     * @param string $url contains the media's url
     * @param string $type contains the media's type
     * @param string $cover contains the media's cover
     * @param integer $size contains the media's size
     * 
     * @return integer with last inserted id or false
     */
    public function save_media( $user_id, $url, $type, $cover, $size ) {
        
        // Set data to save
        $data = array(
            'user_id' => $user_id,
            'body' => $url,
            'cover' => $cover,
            'size' => $size,
            'type' => $type,
            'created' => time()
        );
        
        // Insert data
        $this->db->insert($this->table, $data);
        
        // Verify if the data was inserted
        if ( $this->db->affected_rows() ) {
            
            // Return last inserted ID
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_user_media gets user media by type
     *
     * @param integer $user_id contains the user_id
     * @param integer $page contains the page_id
     * @param integer $limit contains the limit
     * 
     * @return object with medias or false
     */
    public function get_user_medias( $user_id, $page=0, $limit=0 ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('user_id' => $user_id));
        $this->db->order_by('media_id', 'desc');
        $this->db->limit($limit, $page);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            if ( $limit ) {
                $result = $query->result();
                return $result;                
            } else {
                return $query->num_rows();
            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method single_media gets single media by id
     *
     * @param integer $user_id contains the user_id
     * @param integer $media_id contains the media's ID
     * 
     * @return object with single media or false
     */
    public function single_media( $user_id, $media_id ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(['media_id' => $media_id, 'user_id' => $user_id]);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_medias_by_type gets user's medias by type
     *
     * @param integer $user_id contains the user_id
     * @param array $medias contains the medias's ids 
     * 
     * @return array with urls
     */
    public function get_medias_by_type( $user_id, $medias ) {
        
        $this->db->select('media_id,body,cover');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->where_in('media_id', $medias);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result_array();
            return $result;
            
        } else {
            
            return array();
            
        }
        
    }
    
    /**
     * The public method delete_media deletes user's media
     *
     * @param integer $user_id contains the user_id
     * @param integer $media_id contains the media's ID
     * 
     * @return boolean true or false
     */
    public function delete_media( $user_id, $media_id = NULL ) {
        
        // Verify if media_id is not null
        if ( $media_id ) {
            
            $this->db->delete($this->table, ['user_id' => $user_id, 'media_id' => $media_id]);
            
        } else {
            
            $this->db->delete($this->table, ['user_id' => $user_id]);
            
        }
        
        // Verify if media was deleted
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }   
    
}

/* End of file Media.php */
