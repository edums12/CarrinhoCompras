<?php

class DB
{
    public function Add($pId)
    {
        $fp = fopen("db.txt", "a");
 
        $write = fwrite($fp, $pId."|");
        
        fclose($fp);
    }

    public function GetAll()
    {
        $fp = @fopen("db.txt", "r");
    
        $content = @fread($fp, filesize("db.txt"));
        
        @fclose($fp);
        
        $IDs = array();

        foreach ( explode("|", $content) as $key => $id ) {

            if(!empty($id) && is_numeric($id))
            {

                if( !empty($IDs[ (int) $id ]) )
                    $IDs[ (int) $id ]++;

                else
                    $IDs[ (int) $id ] = 1;

            }

        }

        return $IDs;
    }

    public function Clear()
    {
        $fp = @fopen("./db.txt", "a");

        @fclose($fp);

        @chmod ("./db.txt", 0777);

        if( $fp )
            @unlink("./db.txt");
    }

    public function Remove($pId)
    {
        $items = $this->GetAll();

        $this->Clear();       

        $finded = FALSE;

        foreach (array_keys($items) as $key => $item) {
                
            for ( $i = 0; $i < $items[ $item ]; $i++ )
            {
                if( $item != $pId || ($item == $pId && $finded == TRUE))
                {
                    $this->Add($item);
                }
                else
                {
                    $finded = TRUE;
                }
            }
        
        }
    }
}