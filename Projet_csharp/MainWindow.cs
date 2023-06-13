using System;
using Gtk;
using UI = Gtk.Builder.ObjectAttribute;
using Config;

namespace WeatherApp
{
    class MainWindow : Window
    {
        private conf Conf = new conf();
        [UI]
        private Notebook notebook = null;
        [UI]
        private Label ReVille = null;

        [UI]
        private Label ReCoor = null;

        [UI]
        private Label ReDescription = null;

        [UI]
        private Label HVilleCoor = null;

        [UI]
        private Image ReImage = null;

        [UI]
        private Label ReHumid = null;

        [UI]
        private Label ReTemp = null;

        [UI]
        private Label HJour1 = null;

        [UI]
        private Label HDescription1 = null;

        [UI]
        private Label HHumid1 = null;

        [UI]
        private Image HImage1 = null;

        [UI]
        private Label HTemp1 = null;

        [UI]
        private Label HJour2 = null;

        [UI]
        private Label HDescription2 = null;

        [UI]
        private Label HHumid2 = null;

        [UI]
        private Image HImage2 = null;

        [UI]
        private Label HTemp2 = null;

        [UI]
        private Label HJour3 = null;

        [UI]
        private Label HDescription3 = null;

        [UI]
        private Label HHumid3 = null;

        [UI]
        private Image HImage3 = null;

        [UI]
        private Label HTemp3 = null;

        [UI]
        private Label HJour4 = null;

        [UI]
        private Label HDescription4 = null;

        [UI]
        private Label HHumid4 = null;

        [UI]
        private Image HImage4 = null;

        [UI]
        private Label HTemp4 = null;

        [UI]
        private Label HJour5 = null;

        [UI]
        private Label HDescription5 = null;

        [UI]
        private Label HHumid5 = null;

        [UI]
        private Image HImage5 = null;

        [UI]
        private Label HTemp5 = null;

        [UI]
        private Entry ReEntry = null;

        [UI]
        private Button ReButton = null;
        [UI]
        private Entry ParaLangue = null;

        [UI]
        private Entry ParaVilleDefault = null;

        [UI]
        private Button ParaLangueButton = null;

        [UI]
        private Button ParaVilleDefaultButton = null;

        public MainWindow() : this(new Builder("WeatherApp.glade")) { }

        private MainWindow(Builder builder) : base(builder.GetRawOwnedObject("WeatherApp"))
        {
            builder.Autoconnect(this);

            DeleteEvent += Window_DeleteEvent;
            ReButton.Clicked += ReButton_Clicked;
            ParaLangueButton.Clicked += ParaLangueButton_Clicked;
            ParaVilleDefaultButton.Clicked += ParaVilleDefaultButton_Clicked;
            notebook.SwitchPage += Notebook_SwitchPage;

            Home home = new Home();
            Research research = new Research();
            if (home.Error != null)
            {
                MessageDialog md = new MessageDialog(this, DialogFlags.Modal, MessageType.Error, ButtonsType.Ok, research.Error);
                md.Run();
                md.Destroy();
                return;
            }
            else if (research.Error != null)
            {
                MessageDialog md = new MessageDialog(this, DialogFlags.Modal, MessageType.Error, ButtonsType.Ok, research.Error);
                md.Run();
                md.Destroy();
                return;
            }

            HVilleCoor.Text =
                home.Data.city.name
                + " ("
                + home.Data.city.coord.lat
                + "; "
                + home.Data.city.coord.lon
                + ")";
            HJour1.Text = home.Data.list[0].dt_txt;
            HDescription1.Text = home.Data.list[0].weather[0].description;
            HHumid1.Text = String.Format("Humidité : {0} %", home.Data.list[0].main.humidity.ToString());
            HImage1.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[0].weather[0].icon + ".png");
            HTemp1.Text = String.Format("{0}°C", home.Data.list[0].main.temp.ToString());

            HJour2.Text = home.Data.list[1].dt_txt;
            HDescription2.Text = home.Data.list[1].weather[0].description;
            HHumid2.Text = String.Format("Humidité : {0} %", home.Data.list[1].main.humidity.ToString());
            HImage2.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[1].weather[0].icon + ".png");
            HTemp2.Text = String.Format("{0}°C", home.Data.list[1].main.temp.ToString());

            HJour3.Text = home.Data.list[2].dt_txt;
            HDescription3.Text = home.Data.list[2].weather[0].description;
            HHumid3.Text = String.Format("Humidité : {0} %", home.Data.list[2].main.humidity.ToString());
            HImage3.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[2].weather[0].icon + ".png");
            HTemp3.Text = String.Format("{0}°C", home.Data.list[2].main.temp.ToString());

            HJour4.Text = home.Data.list[3].dt_txt;
            HDescription4.Text = home.Data.list[3].weather[0].description;
            HHumid4.Text = String.Format("Humidité : {0} %", home.Data.list[3].main.humidity.ToString());
            HImage4.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[3].weather[0].icon + ".png");
            HTemp4.Text = String.Format("{0}°C", home.Data.list[3].main.temp.ToString());

            HJour5.Text = home.Data.list[4].dt_txt;
            HDescription5.Text = home.Data.list[4].weather[0].description;
            HHumid5.Text = String.Format("Humidité : {0} %", home.Data.list[4].main.humidity.ToString());
            HImage5.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[4].weather[0].icon + ".png");
            HTemp5.Text = String.Format("{0}°C", home.Data.list[4].main.temp.ToString());

            ReVille.Text = research.Data.name;
            ReCoor.Text = "Coordonnées : " + research.Data.coord.lat + "; " + research.Data.coord.lon;
            ReDescription.Text = research.Data.weather[0].description;
            ReHumid.Text = String.Format("Humidité : {0} %", research.Data.main.humidity.ToString());
            ReTemp.Text = String.Format("{0}°C", research.Data.main.temp.ToString());
            ReImage.Pixbuf = new Gdk.Pixbuf("assets/" + research.Data.weather[0].icon + ".png");

            notebook.CurrentPage = 1;
        }

        private void Window_DeleteEvent(object sender, DeleteEventArgs a)
        {
            Application.Quit();
        }

        private void ReButton_Clicked(object sender, EventArgs a)
        {
            Research research = new Research(ReEntry.Text);
            if (research.Error != null)
            {
                MessageDialog md = new MessageDialog(this, DialogFlags.Modal, MessageType.Error, ButtonsType.Ok, research.Error);
                md.Run();
                md.Destroy();
                return;
            }
            ReVille.Text = research.Data.name;
            ReCoor.Text = research.Data.coord.lat + " " + research.Data.coord.lon;
            ReDescription.Text = research.Data.weather[0].description;
            ReHumid.Text = String.Format("Humidité : {0} %", research.Data.main.humidity.ToString());
            ReTemp.Text = String.Format("{0}°C", research.Data.main.temp.ToString());
            ReImage.Pixbuf = new Gdk.Pixbuf("assets/" + research.Data.weather[0].icon + ".png");
        }

        private void ParaLangueButton_Clicked(object sender, EventArgs a)
        {
            Conf.SetLangue(ParaLangue.Text);
        }

        private void ParaVilleDefaultButton_Clicked(object sender, EventArgs a)
        {
            Conf.Setville(ParaVilleDefault.Text);
            Home home = new Home();
            if (home.Error != null)
            {
                MessageDialog md = new MessageDialog(this, DialogFlags.Modal, MessageType.Error, ButtonsType.Ok, home.Error);
                md.Run();
                md.Destroy();
                return;
            }

        }
        private void Notebook_SwitchPage(object o, SwitchPageArgs args)
        {

            if (args.PageNum == 0)
            {
                if (ReEntry.Text == "")
                {
                    Research research = new Research(Conf.ReadJson().Ville);
                    ReVille.Text = research.Data.name;
                    ReCoor.Text = research.Data.coord.lat + "; " + research.Data.coord.lon;
                    ReDescription.Text = research.Data.weather[0].description;
                    ReHumid.Text = String.Format("Humidité : {0} %", research.Data.main.humidity.ToString());
                    ReTemp.Text = String.Format("{0}°C", research.Data.main.temp.ToString());
                    ReImage.Pixbuf = new Gdk.Pixbuf("assets/" + research.Data.weather[0].icon + ".png");
                }

            }
            if (args.PageNum == 1)
            {
                Home home = new Home();
                HVilleCoor.Text =
                home.Data.city.name
                + " ("
                + home.Data.city.coord.lat
                + "; "
                + home.Data.city.coord.lon
                + ")";
                HJour1.Text = home.Data.list[0].dt_txt;
                HDescription1.Text = home.Data.list[0].weather[0].description;
                HHumid1.Text = String.Format("Humidité : {0} %", home.Data.list[0].main.humidity.ToString());
                HImage1.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[0].weather[0].icon + ".png");
                HTemp1.Text = String.Format("{0}°C", home.Data.list[0].main.temp.ToString());

                HJour2.Text = home.Data.list[1].dt_txt;
                HDescription2.Text = home.Data.list[1].weather[0].description;
                HHumid2.Text = String.Format("Humidité : {0} %", home.Data.list[1].main.humidity.ToString());
                HImage2.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[1].weather[0].icon + ".png");
                HTemp2.Text = String.Format("{0}°C", home.Data.list[1].main.temp.ToString());

                HJour3.Text = home.Data.list[2].dt_txt;
                HDescription3.Text = home.Data.list[2].weather[0].description;
                HHumid3.Text = String.Format("Humidité : {0} %", home.Data.list[2].main.humidity.ToString());
                HImage3.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[2].weather[0].icon + ".png");
                HTemp3.Text = String.Format("{0}°C", home.Data.list[2].main.temp.ToString());

                HJour4.Text = home.Data.list[3].dt_txt;
                HDescription4.Text = home.Data.list[3].weather[0].description;
                HHumid4.Text = String.Format("Humidité : {0} %", home.Data.list[3].main.humidity.ToString());
                HImage4.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[3].weather[0].icon + ".png");
                HTemp4.Text = String.Format("{0}°C", home.Data.list[3].main.temp.ToString());

                HJour5.Text = home.Data.list[4].dt_txt;
                HDescription5.Text = home.Data.list[4].weather[0].description;
                HHumid5.Text = String.Format("Humidité : {0} %", home.Data.list[4].main.humidity.ToString());
                HImage5.Pixbuf = new Gdk.Pixbuf("assets/" + home.Data.list[4].weather[0].icon + ".png");
                HTemp5.Text = String.Format("{0}°C", home.Data.list[4].main.temp.ToString());
            }
        }
    }
}
