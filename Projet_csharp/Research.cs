using System;
using System.Net;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Config;

namespace WeatherApp
{
    public class Research : conf
    {
        public DataResearch Data { get; set; }
        public string URL = "https://api.openweathermap.org/data/2.5/weather";
        public string Error;

        public Research(string ville)
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
                        ville,
                        option.Langue,
                        option.Unite,
                        API_KEY
                    )
                )
                .Result;
            if (!response.IsSuccessStatusCode)
            {
                Error = ErrorCatch((int)response.StatusCode);
                return;
            }
            Data = JsonConvert.DeserializeObject<DataResearch>(
                response.Content.ReadAsStringAsync().Result
            )!;
        }

        public Research()
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
                return;
            }
            Data = JsonConvert.DeserializeObject<DataResearch>(
                response.Content.ReadAsStringAsync().Result
            )!;
        }
    }
}
