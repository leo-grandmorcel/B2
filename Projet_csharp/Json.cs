namespace WeatherApp
{
    public struct Coord
    {
        public float lon { get; set; }
        public float lat { get; set; }

        public override string ToString()
        {
            return string.Format("lon: {0}, lat: {1}", lon, lat);
        }
    }

    public struct Weather
    {
        public string description { get; set; }
        public string icon { get; set; }

        public override string ToString()
        {
            return string.Format("description: {0}, icon: {1}", description, icon);
        }
    }

    public struct Main
    {
        public float temp { get; set; }
        public float temp_min { get; set; }
        public float temp_max { get; set; }
        public double humidity { get; set; }

        public override string ToString()
        {
            return string.Format(
                "temp: {0}, temp_min: {1}, temp_max: {2}, humidity: {3}",
                temp,
                temp_min,
                temp_max,
                humidity
            );
        }
    }

    public struct City
    {
        public string name { get; set; }
        public Coord coord { get; set; }

        public override string ToString()
        {
            return string.Format("name: {0}, coord: {1}", name, coord);
        }
    }

    public struct ForeCast
    {
        public Main main { get; set; }
        public Weather[] weather { get; set; }
        public string dt_txt { get; set; }

        public override string ToString()
        {
            return string.Format(
                "dt_text: {0}, main: {1}, weather: {2}",
                dt_txt,
                main,
                string.Join(", ", weather)
            );
        }
    }

    public class DataResearch
    {
        public Coord coord { get; set; }
        public Weather[] weather { get; set; }
        public Main main { get; set; }
        public string name { get; set; }

        public override string ToString()
        {
            return string.Format(
                "coord: {0}, weather: {1}, main: {2}, name: {3}",
                coord,
                string.Join(", ", weather),
                main,
                name
            );
        }

        public DataResearch() { }
    }

    public class DataForeCast
    {
        public ForeCast[] list { get; set; }
        public City city { get; set; }

        public override string ToString()
        {
            return string.Format("List :\n{0}\nCity : {1}", string.Join("\n\t", list), city);
        }

        public DataForeCast() { }
    }
}
