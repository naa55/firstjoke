<?php

// function query($pdo, $sql, $parameters) {
//     $query = $pdo->prepare($sql);
//     foreach($parameters as $name=>$value) {
//             $query->bindValue($name, $value);
//     }
//     $query->execute();
//     return $query;
//     }

function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
    }

function totalJokes($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `jokes`');
    $row = $query->fetch();
    return $row[0];
    }

    function getJoke($pdo, $id) {
        $parameters = [':id' => $id];
        $query = query($pdo, 'SELECT FROM `jokes`
        WHERE `id` = :id', $parameters);
        return $query->fetch();
        }

      

        function deleteJoke($pdo, $id) {
            $parameters = [':id'=> $id];
            query($pdo, 'DELETE FROM `jokes` WHERE `id` = :id', $parameters);
        }

        function allJokes($pdo) {
            $jokes = query($pdo, 'SELECT `jokes`.`id`, `joketext`, `name`, `email`, `jokedate` 
            FROM `jokes` INNER JOIN `author` 
            ON `authorid` = `author`.`id`');
            return $jokes->fetchAll();
        }
        // function updateJoke($pdo, $jokeid, $joketext, $authorid) {
        //     $parameters = [':joketext'=> $joketext, ':authorid' => $authorid, ':jokeid'=> $jokeid];

        //     query($pdo, 'UPDATE `jokes` SET
        //      `authorid` = :authorid, `joketext` = :joketext
        //       WHERE `id` = :id', $parameters);
            

        // }

        function processDates($fields) {
            foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d');
            }
            }
            return $fields;
            }
        




              // function insertJokes($pdo, $joketext, $authorid) {
        //     $query = 'INSERT INTO `jokes`  (`joketext`, `jokedate`, `authorid`) 
        //     VALUES (:joketext, CURDATE(), :authorid)';

        //     $parameters = [':joketext' => $joketext, ':authorid' => $authorid];
        //     query($pdo, $query, $parameters);

        // }
        function updateJoke($pdo, $fields) {
            $query = ' UPDATE `jokes` SET ';
            foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = :' . $key . ',';
            }
            $query = rtrim($query, ',');
            $query .= ' WHERE `id` = :primaryKey';
            // Set the :primaryKey variable
            $fields['primaryKey'] = $fields['id'];
            $fields = processDates($fields);
            query($pdo, $query, $fields);
            }

            function insertJoke($pdo, $fields) {
            $query = 'INSERT INTO `jokes` (';
            foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
            }
            $query = rtrim($query, ',');
            $query .= ') VALUES (';
            foreach ($fields as $key => $value) {
            $query .= ':' . $key . ',';
            }
            $query = rtrim($query, ',');
            $query .= ')';
            $fields = processDates($fields);
            query($pdo, $query, $fields);
            }


        // function insertJoke($pdo, $fields) {
        //     $query = 'INSERT INTO `joke` ('
        //     foreach ($fields as $key => $value) {
        //     $query .= '`' . $key . '`,';
        //     }
        //     $query = rtrim($query, ',');
        //     $query .= ') VALUES (';
        //     foreach ($fields as $key => $value) {
        //     $query .= ':' . $key . ',';
        //     }
        //     $query = rtrim($query, ',');
        //     $query .= ')';
        //     query($pdo, $query);
        //     }

    //         function updateJoke($pdo, $fields) {
    //             $query = ' UPDATE `jokes` SET ';
    //                 foreach ($fields as $key => $value) {
    //                 $query .= '`' . $key . '` = :' . $key . ',';
    //                 }
    //                 $query = rtrim($query, ',');
    //                 $query .= ' WHERE `id` = :primaryKey';
    //                 // Set the :primaryKey variable
    //                 $fields['primaryKey'] = $fields['id'];
    //                 query($pdo, $query, $fields);
    // }

        
    //get All authors

    function allAuthors($pdo) {
        $authors = query($pdo, 'SELECT * FROM `author`');
        return $authors->fetchAll();
    }

    function deleteAuthor($pdo, $id) {
        $parameters = ['id'=> $id];
        query($pdo, 'DELETE FROM `author` WHERE `id` = :id', $parameters);
    }

    function insertAuthor($pdo, $fields) {
        $query = 'INSERT INTO `author` (';

        foreach($fields as $key=>$value) {
            $query .= '`' . $key . '`,';
        }

        $query = rtrim($query, ',');

        $query .= ') VALUES (';

        foreach($fields as $key=>$value) {
            $query .= ':' . $key . ',';
        }
        $query = rtrim($query, ',');

        $query .= ')';

        $fields = processDates($fields);
        query($pdo, $query, $fields);
    }

    ///one function for all instances such as jokes and author

    function findAll($pdo, $table) {
            $result = query($pdo, 'SELECT * FROM `'. $table .'`');
            return $result->fetchAll();
    }

    function delete($pdo, $table, $primaryKey, $id) {
        $parameters = [':id' => $id];
        query($pdo, 'DELETE FROM `' . $table . '`
        WHERE `'.$primaryKey.'` = :id', $parameters);
        }

        function insert($pdo, $table,  $fields) {
            $query = 'INSERT INTO `' .$table.'`(';

            foreach($fields as $key=>$value) {
                $query .= '`' . $key . '`,';
            }

            $query = rtrim($query, ',');
            $query .= ') VALUES (';

            foreach($fields as $key=>$value){
                $query .= ':'. $key. ',';
            }

            $query = rtrim($query, ',');

            $query .=')';

            $fields = processDates($fields);
            query($pdo, $query, $fields);
        }

        function update($pdo, $table, $primaryKey, $fields) {
            $query = 'UPDATE `' .$table .'` SET';
            foreach($fields as $key=>$value) {
                $query .= '`' . $key . '` = :' . $key . ',';
            }
            $query = rtrim($query, ',');
            $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
            $fields['primaryKey'] = $fields['id'];
            $fields = processDates($fields);
            query($pdo, $query, $fields);
        }

        function findById($pdo, $table, $primaryKey, $value) {
            $query = 'SELECT * FROM `' . $table . '`
            WHERE `' . $primaryKey . '` = :value';
            $parameters = [
            'value' => $value
            ];
            $query = query($pdo, $query, $parameters);
            return $query->fetch();
            }
 
            function total($pdo, $table) {
                $query = query($pdo, 'SELECT COUNT(*)
                FROM `' . $table . '`');
                $row = $query->fetch();
                return $row[0];
                }
        function save($pdo,$table, $primaryKey, $record) {
                try {
                    if($record[$primaryKey] == "") {
                        $record[$primaryKey] = null;
                    }
                    insert($pdo, $table, $record);
                } catch(PDOException $e) {
                    update($pdo, $table, $primaryKey, $record);
                }
        }