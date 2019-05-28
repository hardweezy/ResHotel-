<?php

class Room
{
    /**
     * [addNewRoom This is called from the admin section
     * Used to save a new Room Type record
     * @param [array()]
     * @return last_insert_id
     */
    public function addNewRoom($post)
    {
        $sql = DB::insert('rooms', array(
            'name' => $_POST['roomName'],
            'description' => $_POST['roomDescription'],
            'number_of_rooms' => $_POST['numberOfRooms'],
            'adult_max_capacity' => $_POST['adultMaxCapacity'],
            'child_max_capacity' => $_POST['childMaxCapacity'],
            'price' => $_POST['priceRoom'],
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ));
        
        if ($sql) {
            if (isset($_SESSION['room_number'])) {
                unset($_SESSION['room_number']);
            }
            $_SESSION['room_number'] = DB::insertId();
            
            return $_SESSION['room_number'];
        }
        
    }
    
    public function fetchRoomsJSON()
    {
        $sql = DB::query('SELECT DISTINCT r.id,r.name,r.number_of_rooms,
						r.price,r.child_max_capacity,r.adult_max_capacity,u.*
						FROM rooms r
						INNER JOIN(
							SELECT room_id, name as upload_name
							FROM uploads
							GROUP BY room_id
							)AS u ON u.room_id = r.id
							WHERE r.id IS NOT NULL
							ORDER BY r.id DESC');
        
        echo json_encode(array(
            "recordsFiltered" => count($sql),
            "recordsTotal" => count($sql),
            'data' => $sql
        ));
    }
    
    public function fetchBookingsJSON()
    {
        $sql = DB::query('SELECT DISTINCT r.id,r.name,r.number_of_rooms,
							r.price,r.child_max_capacity,r.adult_max_capacity,CONCAT(g.first_name," ", g.last_name) as fullname,rs.*
							FROM rooms r
							INNER JOIN(
										SELECT id as reservations_id,room_id, 
                                        guest_id, date_in,date_out, amount_charged,
										adult_count, child_count, room_number
										FROM reservations
										GROUP BY guest_id
								)AS rs ON rs.room_id = r.id
								INNER JOIN guests g ON g.id = rs.guest_id
								WHERE r.id IS NOT NULL
								ORDER BY rs.reservations_id DESC');
        
        echo json_encode(array(
            "recordsFiltered" => count($sql),
            "recordsTotal" => count($sql),
            'data' => $sql
        ));
    }
    
    public function fetchRooms()
    {
        $sql = DB::query('SELECT DISTINCT r.id,r.name,
			r.price,r.child_max_capacity,r.adult_max_capacity,u.*
			FROM rooms r
			INNER JOIN(
				SELECT room_id, name as upload_name
				FROM uploads
				GROUP BY room_id
				)AS u ON u.room_id = r.id
					WHERE r.id IS NOT NULL
					ORDER BY r.id DESC LIMIT 4');
        if ($sql):
            return $sql;
        endif;
    }
    
    public function fetchRoomsFromSearch($get)
    {
        $gump   = new GUMP();
        $carbon = new Carbon\Carbon();
        $_GET   = $gump->sanitize($get);
        
        $sql = DB::query('SELECT r.*,u.* FROM rooms r
							INNER JOIN(
							SELECT room_id, name as upload_name
							FROM uploads
							GROUP BY room_id
							)AS u ON u.room_id = r.id
							LEFT JOIN reservations rs
							ON rs.room_id = r.id
							AND rs.date_out >= %s
							AND rs.date_in <= %s
							WHERE r.number_of_rooms >= %i
							AND r.adult_max_capacity >=%i
							AND r.child_max_capacity >=%i
							AND rs.room_id IS NULL
							ORDER BY r.price ASC', 

                            date("Y-m-d", strtotime($_GET['arrival'])), 
                            date("Y-m-d", strtotime($_GET['departure'])), 
                            $_GET['roomCapacity'], 
                            $_GET['adultCapacity'], 
                            $_GET['childCapacity']

                            );
        
        if ($sql):
            return $sql;
        endif;
    }
    
      /**
       * This is just expected to successfully store all
       * needed keys for later use should you want to proceed
       * with booking your result.
       * No need to put it in the DB, allowed $_SESSION take care of it
     ** @param [array()]
     * @return Associative array
     */
    public function reservationSummary($post)
    {
        $carbon = new Carbon\Carbon();
        
        $gump  = new GUMP();
        $_POST = $gump->sanitize($post);
        
        
        $sql = DB::queryFirstRow('SELECT DISTINCT r.id,r.name,
			r.price,r.child_max_capacity,r.adult_max_capacity,u.*
			FROM rooms r
			INNER JOIN(
				SELECT room_id, name as upload_name
				FROM uploads
				GROUP BY room_id
				)AS u ON u.room_id = r.id
					WHERE r.id IS NOT NULL
					AND r.id=%i', $_POST['id']);
        
        if ($sql):
            if (isset($_SESSION['reservation'])) {
                unset($_SESSION['reservation']);
                unset($_SESSION['reservation_meta']);
            }
            $departureDate = strtotime($_POST['departure']); // or your date as well
            $arrivalDate   = strtotime($_POST['arrival']);
            $subDates      = abs($departureDate - $arrivalDate);
            $littleCheck   = floor($subDates / (60 * 60 * 24));
            
            $diffInDate = ($littleCheck < 1) ? 1 : $littleCheck;
            
            $totalMeta = abs(($diffInDate) * ($sql['price']));
            
            $_SESSION['reservation']      = $sql;
            $_SESSION['reservation_meta'] = array(
                'childCapacity' => $_POST['childCapacity'],
                'adultCapacity' => $_POST['adultCapacity'],
                'roomsCount' => $_POST['roomCapacity'],
                'dateDiff' => $diffInDate,
                'total' => $totalMeta,
                'arrival' => $_POST['arrival'],
                'departure' => $_POST['departure']
            );
            
            
            return true;
        endif;
    }
    
     /**
      * Query to take all useful data from visitor,
      * Guest details and stored $_SESSION properties and
      * save them into DB
     ** @param [array()]
     * @return  last_insert_id as Reservation Number
     */
    public function checkoutReservation($post)
    {
        
        $carbon = new Carbon\Carbon();
        $gump  = new GUMP();
        $_POST = $gump->sanitize($post);
        
        $sql = DB::insert('guests', array(
            'first_name' => $_POST['guestFirstName'],
            'last_name' => $_POST['guestLastName'],
            'email_address' => $_POST['guestEmail'],
            'cellphone' => $_POST['guestPhone'],
            'home_address' => $_POST['guestAddress'] . ' ' . $_POST['guestAddress2']. ' ' .$_POST['guestPostalCode'] ,
            'country' => $_POST['guestCountry'],
            'created_at' => $carbon->now(),
            'updated_at' => $carbon->now()
        ));
        
        if ($sql):
            $last_id = DB::insertId();
            $result  = $this->createNewReservation($last_id);
            return $result;
        endif;
    }
    
     /**
      * Query to take all useful data from visitor,
      * Guest details and stored $_SESSION properties and
      * save them into DB
     ** @param [array()]
     * @return  last_insert_id as Reservation Number
     */
    public function createNewReservation($id)
    {
        $carbon = new Carbon\Carbon();
        
        if (isset($_SESSION['reservation']) && isset($_SESSION['reservation_meta'])):
            $sql = DB::insert('reservations', array(
                'room_id' => $_SESSION['reservation']['id'],
                'guest_id' => $id,
                'date_in' => date("Y-m-d", strtotime($_SESSION['reservation_meta']['arrival'])),
                'date_out' => date("Y-m-d", strtotime($_SESSION['reservation_meta']['departure'])),
                'amount_charged' => $_SESSION['reservation_meta']['total'],
                'status' => 1,
                'adult_count' => $_SESSION['reservation']['adult_max_capacity'],
                'child_count' => $_SESSION['reservation']['child_max_capacity'],
                'room_number' => $_SESSION['reservation_meta']['roomsCount'],
                'created_at' => $carbon->now(),
                'updated_at' => $carbon->now()
            ));
            if ($sql):
                $echoRs = DB::insertId();
                return $echoRs;
            endif;
        endif;
    }

    /**
     * [fetchSingleBooking fetch more details about this reservation]
     * @param  [reservation_id]  [takes this and get all info about it]
     * @return [array()]     []
     */
    public function fetchSingleBooking($id)
    {
        $sql = DB::queryFirstRow('SELECT DISTINCT r.name,r.price,r.number_of_rooms,
                                r.adult_max_capacity,r.child_max_capacity,
                                CONCAT(g.first_name," ", g.last_name) as fullname,
                                g.email_address,g.cellphone,g.country,g.home_address,rs.*
                                FROM rooms r
                                INNER JOIN(
                                            SELECT id as reservations_id,room_id, 
                                            guest_id, date_in,date_out, amount_charged,
                                            adult_count, child_count, room_number, created_at
                                            FROM reservations
                                            GROUP BY guest_id
                                    )AS rs ON rs.room_id = r.id
                                    INNER JOIN guests g ON g.id = rs.guest_id
                                    WHERE r.id IS NOT NULL
                                    AND rs.reservations_id = %i
                                    ORDER BY r.id DESC',$id);
        
        if($sql):
            return $sql;
        endif;
    }

}
