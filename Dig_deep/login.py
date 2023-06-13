import sys, pygame, pygame_gui, subprocess

pygame.init()

# Vars
screen_size = (800, 600)
screen = pygame.display.set_mode(screen_size)
FONT_SIZE = 20
font = pygame.font.SysFont(None, FONT_SIZE)
clock = pygame.time.Clock()
gui = pygame_gui.UIManager(screen_size)

# SQL
# db = pymysql.connect(
#  host="bite",
#  user="chatte",
#  password="couilles",
#  database="nibards"
# )

# Login
# def check_login(username, password):
#    cursor = db.cursor();
#    query = "SELECT * FROM users WHERE username=%s AND password=%s";
#    values = (username, password);
#    cursor.execute(query, values);
#    result = cursor.fetchone();
#    cursor.close();
#    return result is not None;

# Create account
# def create_account(username, password):
#    cursor = db.cursor()
#    Adapter la query pr compléter les values manquantes
#    query = "INSERT INTO users (username, password) VALUES (%s, %s)"
#    values = (username, password)
#    cursor.execute(query, values)
#    db.commit()
#    cursor.close()


# Labels
page_name = pygame_gui.elements.UILabel(
    relative_rect=pygame.Rect((350, 50), (100, 50)), text="Login", manager=gui
)
username_label = pygame_gui.elements.UILabel(
    relative_rect=pygame.Rect((150, 200), (100, 50)), text="Username:", manager=gui
)
password_label = pygame_gui.elements.UILabel(
    relative_rect=pygame.Rect((150, 300), (100, 50)), text="Password:", manager=gui
)

# Fields
username_input = pygame_gui.elements.UITextEntryLine(
    relative_rect=pygame.Rect((275, 200), (250, 50)), manager=gui
)
password_input = pygame_gui.elements.UITextEntryLine(
    relative_rect=pygame.Rect((275, 300), (250, 50)), manager=gui
)

# Buttons
login_button = pygame_gui.elements.UIButton(
    relative_rect=pygame.Rect((350, 400), (100, 50)), text="Login", manager=gui
)
signin_button = pygame_gui.elements.UIButton(
    relative_rect=pygame.Rect((350, 500), (100, 50)), text="Sign In", manager=gui
)
create_account_button = pygame_gui.elements.UIButton(
    relative_rect=pygame.Rect((315, 400), (170, 50)), text="Create Account", manager=gui
)
already_account_button = pygame_gui.elements.UIButton(
    relative_rect=pygame.Rect((315, 500), (170, 50)),
    text="Already an account ?",
    manager=gui,
)


class Login:
    @staticmethod
    def show():
        page_name.set_text("Login")
        login_button.show()
        signin_button.show()

    @staticmethod
    def hide():
        page_name.set_text("")
        login_button.hide()
        signin_button.hide()


class Signin:
    @staticmethod
    def show():
        page_name.set_text("Sign In")
        create_account_button.show()
        already_account_button.show()

    @staticmethod
    def hide():
        page_name.set_text("")
        create_account_button.hide()
        already_account_button.hide()


class Game:
    @staticmethod
    def show():
        page_name.set_text("Game")

    @staticmethod
    def hide():
        page_name.set_text("")


# Set the initial GUI to the login GUI
Signin.hide()
Login.show()
pygame.display.update()

while True:
    time_delta = clock.tick(60) / 1000.0

    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
            sys.exit()
        gui.process_events(event)

        if event.type == pygame_gui.UI_BUTTON_PRESSED:
            if event.ui_element == login_button:
                username = username_input.get_text()
                password = password_input.get_text()
                print("Username:", username)
                print("Password:", password)
                # Query return
                # if check_login(username, password):
                #    print("Login successful")
                # else:
                #    print("Incorrect username or password")
            if event.ui_element == create_account_button:
                username = username_input.get_text()
                password = password_input.get_text()
                # create_account(username, password);
                #   if username == "" or password == "":
                #       print("Please enter a username and a password");
                #   else:
                #       print("Account created successfully");
                print("Username:", username)
                print("Password:", password)
            if event.ui_element == already_account_button:
                # Switch to the login GUI
                Signin.hide()
                Login.show()
                pygame.display.update()
            if event.ui_element == signin_button:
                # Switch to the signin GUI
                Login.hide()
                Signin.show()
                pygame.display.update()

    gui.update(time_delta)
    screen.fill((104, 104, 104))
    gui.draw_ui(screen)
    pygame.display.update()
