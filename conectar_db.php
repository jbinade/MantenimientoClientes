<?php

    //clase cliente
    class cliente {

        public $dni;
        public $nombre;
        public $direccion;
        public $localidad;
        public $provincia;
        public $telefono;
        public $email;
        public $rol;
        public $contrasena;


        public function __construct($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email, $rol, $contrasena) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->localidad = $localidad;
            $this->provincia = $provincia;
            $this->telefono = $telefono;
            $this->email = $email;
            $this->rol = $rol;
            $this->contrasena = $contrasena;

        }

        
    }

    //clase conexion
    class Conexion {

        private $host = "localhost";
        private $baseDatos = "clientesdb2";
        private $usuario = "root";
        private $password = "";

        //funcion para conectar a la base de datos
        public function conectar_db() {

            $dsn = "mysql:host=$this->host;dbname=$this->baseDatos";

            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                $con = new PDO($dsn, $this->usuario, $this->password, $opciones);
                return $con;

            } catch(PDOException $e) {
                echo 'Error: '.$e->getMessage();
            }

        }

        //funcion para realizar consultas que devuelve un array de clientes
        public function consultar() {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('SELECT * FROM clientes');
                $stmt->execute();
                $clientes = [];

                while($row = $stmt->fetch()) {
                    $cliente = new Cliente($row['dni'], $row['nombre'], $row['direccion'], $row['localidad'], $row['provincia'], $row['telefono'], $row['email'], $row['rol'], $row['contrasena']);           
                    $clientes [] = $cliente;

                }

                return $clientes;

            } catch(PDOEXception $e) {
                    echo 'Error al realizar la consulta: ' . $e->getMessage();
            }

            
        }

        //funcion que recibe un cliente e inserta los datos en la base de datos
        public function insertar(Cliente $cliente) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare(
                    'INSERT INTO clientes (dni, nombre, direccion, localidad, provincia, telefono, email, contrasena) VALUES (:dni, :nombre, :direccion, :localidad, :provincia, :telefono, :email, :contrasena)');

                $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR);
                $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR);
                $stmt->bindParam(':direccion', $cliente->direccion, PDO::PARAM_STR);
                $stmt->bindParam(':localidad', $cliente->localidad, PDO::PARAM_STR);
                $stmt->bindParam(':provincia', $cliente->provincia, PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR);
                $stmt->bindParam(':email', $cliente->email, PDO::PARAM_STR);
                $stmt->bindParam(':contrasena', $cliente->contrasena, PDO::PARAM_STR);
                

                $stmt->execute();


                return true;

            } catch(PDOException $e) {
                echo 'Error al insertar el cliente: ' . $e->getMessage();
            }

        }

        //funcion que recibe un cliente y actualiza los datos
        public function actualizar(Cliente $cliente) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare(
                    'UPDATE clientes SET nombre = :nombre, direccion = :direccion, localidad = :localidad, provincia = :provincia, telefono = :telefono, email = :email, rol = :rol, contrasena = :contrasena WHERE dni = :dni'   
                );

                $stmt->bindParam(':nombre', $cliente->nombre, PDO::PARAM_STR);
                $stmt->bindParam(':direccion', $cliente->direccion, PDO::PARAM_STR);
                $stmt->bindParam(':localidad', $cliente->localidad, PDO::PARAM_STR);
                $stmt->bindParam(':provincia', $cliente->provincia, PDO::PARAM_STR);
                $stmt->bindParam(':telefono', $cliente->telefono, PDO::PARAM_STR);
                $stmt->bindParam(':email', $cliente->email, PDO::PARAM_STR);
                $stmt->bindParam(':rol', $cliente->rol, PDO::PARAM_STR);
                $stmt->bindParam(':contrasena', $cliente->contrasena, PDO::PARAM_STR);
                $stmt->bindParam(':dni', $cliente->dni, PDO::PARAM_STR);

                $stmt->execute();

                return true;

            } catch(PDOException $e) {
                echo 'Error al actualizar el cliente: ' . $e->getMessage();
            }

        }

        //funcion que recibe un dni y elimina un cliente en funcion de dicho dni
        public function borrar($dni) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('DELETE FROM clientes WHERE dni = :dni');
                $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->rowCount() > 0;

            } catch(PDOException $e) {
                echo 'Error al borrar el cliente: ' . $e->getMessage();
            }

        }    

        
        public function buscarDNI($dni) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('SELECT * FROM clientes WHERE dni = :dni');
                $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->rowCount() > 0;

            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        //funcion que recibe una contraseña y busca clientes en funcion de dicha contraseña
        public function buscarContrasena($contrasena) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('SELECT * FROM clientes WHERE contrasena = :contrasena');
                $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->rowCount() > 0;

            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        //funcion para verificar el rol a iniciar sesion
        public function verificarLogin($dni, $contrasena) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('SELECT dni, rol FROM clientes WHERE dni = :dni AND contrasena = :contrasena');
                $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
                $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        //funcion para buscar un cliente a partir de un dni
        public function buscarCliente($dni) {

            $con = $this->conectar_db();

            try {
                $stmt = $con->prepare('SELECT * FROM clientes WHERE dni = :dni');
                $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
                $stmt->execute();

                $res = $stmt->fetch(PDO::FETCH_OBJ);

                if($res) {
                    $cliente = new Cliente(
                        $res->dni,
                        $res->nombre,
                        $res->direccion,
                        $res->localidad,
                        $res->provincia,
                        $res->telefono,
                        $res->email,
                        $res->rol,
                        $res->contrasena
                    );

                    return $cliente;
                } else {
                    return null;
                }

            } catch(PDOException $e) {
                echo 'Error al buscar el cliente: ' . $e->getMessage();
            }

        }

    }
     
?>

