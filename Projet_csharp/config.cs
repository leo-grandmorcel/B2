using System;
using System.IO;
using System.Text;
using Newtonsoft.Json;

namespace Config
{
    public class conf
    {
        public static string API_KEY = File.ReadAllText("Api_key.txt");

        public struct Option
        {
            public string Ville;
            public string Langue;
            public string Unite;
        }

        public Option ReadJson()
        {
            string Json = File.ReadAllText("option.json");
            Option option = JsonConvert.DeserializeObject<Option>(Json);
            return option;
        }

        public void CreateFile()
        {
            if (!File.Exists("option.json"))
            {
                File.Create("option.json").Close();
                Option option = new Option();
                option.Ville = "Bordeaux";
                option.Langue = "FR";
                option.Unite = "metric";
                string Json = JsonConvert.SerializeObject(option, Formatting.Indented);
                File.WriteAllText("option.json", Json);
            }
        }

        public void Setville(string ville)
        {
            Option option = ReadJson();
            option.Ville = ville;
            string Json = JsonConvert.SerializeObject(option, Formatting.Indented);
            File.WriteAllText("option.json", Json);
        }

        public void SetLangue(string langue)
        {
            Option option = ReadJson();
            option.Langue = langue;
            string Json = JsonConvert.SerializeObject(option, Formatting.Indented);
            File.WriteAllText("option.json", Json);
        }

        public void SetUnit(string unite)
        {
            Option option = ReadJson();
            option.Unite = unite;
            string Json = JsonConvert.SerializeObject(option, Formatting.Indented);
            File.WriteAllText("option.json", Json);
        }

        public string ErrorCatch(int error)
        {
            string Error = "";
            switch (error)
            {
                case 400:
                    Error = "Bad Request";
                    break;
                case 401:
                    Error = "Unauthorized";
                    break;
                case 403:
                    Error = "Forbidden";
                    break;
                case 404:
                    Error = "City not Found";
                    break;
                case 429:
                    Error = "Too Many Requests";
                    break;
                case 500:
                    Error = "Internal Server Error";
                    break;
                case 502:
                    Error = "Bad Gateway";
                    break;
                case 503:
                    Error = "Service Unavailable";
                    break;
                case 504:
                    Error = "Gateway Timeout";
                    break;
                default:
                    Error = "Unknown Error";
                    break;
            }

            return Error;
        }
    }
}
