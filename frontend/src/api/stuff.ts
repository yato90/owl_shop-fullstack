import axios, { AxiosResponse } from "axios";
import baseURL from "./index";

//const baseURL: string | undefined = "http://localhost/api";

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

export interface StuffInfo {
  id: number;
  stuff_id: number;
  title: string;
  description: string;
}

export interface StuffFilters {
  id: number;
  name: string;
  price: number;
  img: string;
  type_id: number;
  rating: number;
  stuffInfo: StuffInfo[];
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

export const getFilteredStuff = async (filters: any): Promise<StuffFilters[]> => {
  try {
    const response: AxiosResponse<StuffFilters[]> = await api.get('/stuff/filter', { params: filters });
    return response.data;
  } catch (error) {
    console.error('Error fetching filtered stuff:', error);
    throw error;
  }
};

