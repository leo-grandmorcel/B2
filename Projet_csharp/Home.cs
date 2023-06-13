using System;
using System.Net;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Config;

namespace WeatherApp
{
    public class Home : conf
    {
        public DataForeCast Data { get; set; }

        public string URL = "https://api.openweathermap.org/data/2.5/forecast";
        public string Error;

        public Home()
        {
            var option = ReadJson();
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri(URL);
            client.DefaultRequestHeaders.Accept.Add(
                new MediaTypeWithQualityHeaderValue("application/json")
            );
            var response = client
                .GetAsync(
                    string.Format(
                        "?q={0}&lang={1}&units={2}&appid={3}",
                        option.Ville,
                        option.Langue,
                        option.Unite,
                        API_KEY
                    )
                )
                .Result;
            if (!response.IsSuccessStatusCode)
            {                
                Error = ErrorCatch((int)response.StatusCode);
                Setville("Bordeaux");
                response = client
                    .GetAsync(
                        string.Format(
                            "?q={0}&lang={1}&units={2}&appid={3}",
                            "Bordeaux",
                            option.Langue,
                            option.Unite,
                            API_KEY
                        )
                    )
                    .Result;
            }
            Data = JsonConvert.DeserializeObject<DataForeCast>(
            response.Content.ReadAsStringAsync().Result
            )!;
            var temp = new ForeCast[5];
            var i = 0;
            foreach (var item in Data.list)
            {
                if (item.dt_txt.Contains("12:00:00"))
                {
                    temp[i] = item;
                    i++;
                }
            }
            Data.list = temp;
        }
    }
}
