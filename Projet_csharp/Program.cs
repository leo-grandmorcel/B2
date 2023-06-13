using System;
using Gtk;
using Config;

namespace WeatherApp
{
    class Program
    {
        [STAThread]
        public static void Main(string[] args)
        {
            Application.Init();
            conf Conf = new conf();
            Conf.CreateFile();

            var app = new Application("org.WeatherApp.WeatherApp", GLib.ApplicationFlags.None);
            app.Register(GLib.Cancellable.Current);

            var win = new MainWindow();
            app.AddWindow(win);

            win.Show();
            Application.Run();
        }
    }
}
