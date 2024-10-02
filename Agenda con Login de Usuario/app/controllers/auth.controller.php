<?php
//importo lo relacionado a la session de usuario
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';

//creo la clase

class AuthController
{
    private $view;
    private $model;
    private $user = null;

    public function __construct($res)
    {
        $this->view = new AuthView($res->user);
        $this->model = new UserModel();
    }


    public function showLogin()
    {
        $taskModel = new TaskModel();
        $task = $taskModel->getTasks();
        // Muestro el formulario de login
        return $this->view->showLogin($task);
    }


    public function login()
    {
        // Validación de campos requeridos
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falta completar el email');
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }

        // Captura de datos
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verificar que el usuario está en la base de datos
        $userFromDB = $this->model->getUserByEmail($email);

        // Comprobar si el usuario existe y si la contraseña coincide
        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            // Iniciar sesión y guardar información del usuario
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['NAME_USER'] = $userFromDB->nombre;

            // Redirigir al home
            header('Location: ' . BASE_URL);
            exit;
        } else {
            $taskModel = new TaskModel();
            $task = $taskModel->getTasks();
            return $this->view->showLogin($task, 'Credenciales incorrectas');
        }
    }




    public function createLogin()
    {
        // Inicializar $user como null antes de verificar el registro
        $user = null;
        $errorView = new TaskView($user); // Pasa $user como null si no está registrado


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validaciones
            if (!isset($_POST['email']) || empty($_POST['email'])) {
                $error = "Error: falta completar el email";
                $redir = "registrarse";
                return $errorView->showError($error, $redir);
            }
            if (!isset($_POST['password']) || empty($_POST['password'])) {
                $error = "Error: falta completar la contraseña";
                $redir = "registrarse";
                return $errorView->showError($error, $redir);
            }
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                $error = "Error: falta completar el nombre";
                $redir = "registrarse";
                return $errorView->showError($error, $redir);
            }

            // Obtener datos del formulario
            $email = $_POST['email'];
            $password = $_POST['password'];
            $nombre = $_POST['nombre'];

            if ($this->model->userExists($email)) {
                $error = "Error: El email ya está registrado.";
                $redir = "registrarse";
                return $errorView->showError($error, $redir);
            }

            // Crear el usuario
            $id = $this->model->createUser($email, $password, $nombre);

            // Comprobar si la creación fue exitosa
            if (!$id) {
                $error = "No se pudo crear el usuario. Es posible que el email ya esté en uso.";
                $redir = "showLogin";
                return $errorView->showError($error, $redir);
            } else $error = "Usuario creado con exito, gracias $nombre";
            $redir = "showLogin";
            return $errorView->showError($error, $redir);
        } else {
            // Mostrar formulario de registro si no se ha enviado el formulario
            $this->view->showAddUser($errorView); // Asegúrate de tener este método en la vista
        }
    }


    public function logout()
    {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}
