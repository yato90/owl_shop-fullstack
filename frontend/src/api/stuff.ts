import axios, { AxiosResponse } from "axios";

const baseURL: string | undefined = "http://localhost/api";

const api = axios.create({
  baseURL,
});

export interface Stuff {
  id: number;
  name: string;
  price: number;
  img: string;
  type: string;
  rating: number;
}

export const getAllStuff = async (): Promise<any> => {
  try {
    const response: AxiosResponse<any> = await api.get('/stuff');
    return response.data;
  } catch (error) {
    console.error('Error fetching stuff:', error);
    throw error;
  }
};

// Другие методы для работы с продуктами...
